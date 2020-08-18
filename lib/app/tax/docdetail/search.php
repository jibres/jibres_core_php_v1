<?php
namespace lib\app\tax\docdetail;


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
			'order'   => 'order',
			'sort'    => ['enum' => ['number', 'date']],
			'year_id' => 'id',
			'contain' => 'id',

		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and          = [];
		$meta         = [];
		$or           = [];
		$meta['join'] = [];

		$meta['limit'] = 10;
		// $meta['pagination'] = false;

		$order_sort  = null;


		if(mb_strlen($_query_string) > 50)
		{
			\dash\notif::error(T_("Please search by keyword less than 50 characters"), 'q');
			return false;
		}

		if($data['year_id'])
		{
			$and[] = " tax_docdetail.year_id = $data[year_id] ";
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
					$and[] = " (tax_docdetail.assistant_id IN ($load_all_child) OR tax_docdetail.details_id IN ($load_all_child) ) ";

				}
			}
		}

		$query_string = \dash\validate::search($_query_string);

		if($query_string)
		{
			$or[] = " tax_docdetail.number LIKE '%$query_string%' ";
			$or[] = " tax_docdetail.desc LIKE '%$query_string%' ";
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
			$order_sort = " ORDER BY tax_docdetail.id ASC";
		}

		$list = \lib\db\tax_docdetail\search::list($and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['\\lib\\app\\tax\\docdetail\\ready', 'row'], $list);

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