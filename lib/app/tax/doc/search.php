<?php
namespace lib\app\tax\doc;


class search
{

	private static $filter_message = null;
	private static $filter_args    = [];
	private static $is_filtered    = false;


	public static function filter_message()
	{
		return self::$filter_message;
	}


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	public static function list($_query_string, $_args)
	{

		$condition =
		[
			'order'     => 'order',
			'sort'      => ['enum' => ['number', 'date']],
			'year_id'   => 'id',
			'contain'   => 'id',
			'startdate' => 'date',
			'enddate'   => 'date',
			'month'     => ['enum' => [1,2,3,4,5,6,7,8,9,10,11,12]],
		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and          = [];
		$meta         = [];
		$or           = [];
		$meta['join'] = [];

		$meta['limit'] = 50;
		// $meta['pagination'] = false;

		$order_sort  = null;


		if(mb_strlen($_query_string) > 50)
		{
			\dash\notif::error(T_("Please search by keyword less than 50 characters"), 'q');
			return false;
		}

		if($data['year_id'])
		{
			$and[] = " tax_document.year_id = $data[year_id] ";
		}

		if($data['contain'])
		{
			$load_all_child = \lib\db\tax_coding\get::all_child_id($data['contain']);
			if($load_all_child)
			{
				$load_all_child = array_map('floatval', $load_all_child);
				$load_all_child = array_filter($load_all_child);
				$load_all_child = array_unique($load_all_child);

				if($load_all_child)
				{
					$load_all_child = implode(',', $load_all_child);
					$meta['join'][] = " INNER JOIN tax_docdetail ON tax_docdetail.tax_document_id = tax_document.id ";
					$and[] = " (tax_docdetail.assistant_id IN ($load_all_child) OR tax_docdetail.details_id IN ($load_all_child) ) ";

				}
			}
		}

		if($data['month'])
		{
			if(\dash\language::current() === 'fa')
			{
				$year = date("Y");
				if($data['year_id'])
				{
					$load_year = \lib\app\tax\year\get::get($data['year_id']);
					if(isset($load_year['startdate']))
					{
						$year = \dash\fit::date($load_year['startdate']);
						$year = \dash\utility\convert::to_en_number($year);
						$year = date("Y", strtotime($year));
						list($startdate, $enddate) = \dash\utility\jdate::jalali_month($year, $data['month']);
						$and[] = " tax_document.date >= '$startdate' AND tax_document.date <= '$enddate' ";
					}
				}
			}
			else
			{
				$and[] = " MONTH(tax_document.date) = $data[month] ";
			}
		}

		if($data['startdate'])
		{
			$and[] = " tax_document.date >= '$data[startdate]' ";
		}

		if($data['enddate'])
		{
			$and[] = " tax_document.date <= '$data[enddate]' ";
		}




		$query_string = \dash\validate::search($_query_string);

		if($query_string)
		{
			$or[] = " tax_document.number LIKE '%$query_string%' ";
			$or[] = " tax_document.desc LIKE '%$query_string%' ";
			self::$is_filtered = true;
		}

		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['datecreated']))
			{
				$sort = mb_strtolower($data['sort']);
				$order = null;
				if($data['order'])
				{
					$order = mb_strtolower($data['order']);
				}

				$order_sort = " ORDER BY $sort $order";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY tax_document.number ASC";
		}

		$list = \lib\db\tax_document\search::list($and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['\\lib\\app\\tax\\doc\\ready', 'row'], $list);

		$filter_args_data = [];

		foreach (self::$filter_args as $key => $value)
		{
			if(isset($list[0][$key]) && substr($value, 0, 1) === '*')
			{
				$filter_args_data[substr($value, 1)] = $list[0][$key];
			}
			else
			{
				$filter_args_data[$key] = $value;
			}
		}

		self::$filter_message = \dash\app\sort::createFilterMsg($query_string, $filter_args_data);

		return $list;
	}

}
?>