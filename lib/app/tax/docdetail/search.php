<?php
namespace lib\app\tax\docdetail;


class search
{

	private static $filter_message = null;
	private static $filter_args    = [];
	private static $is_filtered    = false;
	private static $summary_detail    = [];


	public static function summary_detail()
	{
		return self::$summary_detail;
	}

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
			'order'           => 'order',
			'sort'            => ['enum' => ['number', 'date']],
			'year_id'         => 'id',
			'contain'         => 'id',
			'group'           => 'id',
			'total'           => 'id',
			'assistant'       => 'id',
			'details'         => 'id',
			'startdate'       => 'date',
			'enddate'         => 'date',
			'export'          => 'bit',
			'status_verify'   => 'bit',
			'status_unverify' => 'bit',
			'limit'           => 'int',
			'pagination'      => 'bool',
			'summary_detail'  => 'bool',


		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and          = [];
		$where_date   = [];
		$meta         = [];
		$or           = [];
		$meta['join'] = [];


		$meta['limit'] = 50;
		if($data['limit'])
		{
			$meta['limit'] = $data['limit'];
		}

		if($data['pagination'] === null)
		{
			$meta['pagination'] = true;
		}
		else
		{
			$meta['pagination'] = $data['pagination'];
		}

		if($data['export'])
		{
			$meta['pagination'] = false;
		}



		$order_sort  = null;


		if(mb_strlen($_query_string) > 50)
		{
			\dash\notif::error(T_("Please search by keyword less than 50 characters"), 'q');
			return false;
		}

		if($data['year_id'])
		{
			$and[] = " tax_docdetail.year_id = $data[year_id] ";
			$where_date[] = " myTaxDocDetail.year_id = $data[year_id] ";
		}

		if($data['contain'])
		{
			$and[] =
			"
				(
					tax_docdetail.assistant_id IN
					(
						SELECT
							tax_coding.id
						FROM
							tax_coding
						WHERE
							tax_coding.id = $data[contain] OR
							tax_coding.parent1 = $data[contain] OR
							tax_coding.parent2 = $data[contain] OR
							tax_coding.parent3 = $data[contain]
					)
					OR

					tax_docdetail.details_id IN
					(
						SELECT
							tax_coding.id
						FROM
							tax_coding
						WHERE
							tax_coding.id = $data[contain] OR
							tax_coding.parent1 = $data[contain] OR
							tax_coding.parent2 = $data[contain] OR
							tax_coding.parent3 = $data[contain]
					)
				)
			";


		}


		if($data['group'])
		{
			$and[] =
			"
				(
					tax_docdetail.assistant_id IN 	( SELECT tax_coding.id AS `id` FROM tax_coding WHERE tax_coding.id = $data[group] OR tax_coding.parent1 = $data[group] )
					OR
					tax_docdetail.details_id IN 	( SELECT tax_coding.id AS `id` FROM tax_coding WHERE tax_coding.id = $data[group] OR tax_coding.parent1 = $data[group] )
				)
			";
		}



		if($data['total'])
		{
			$myGroupQuery = null;

			if($data['group'])
			{
				$myGroupQuery = " AND tax_coding.parent1 = $data[group] ";
			}

			$total_ids_query = "SELECT tax_coding.id AS `id` FROM tax_coding WHERE (tax_coding.id = $data[total] OR tax_coding.parent2 = $data[total] ) $myGroupQuery ";

			$and[] = " ( tax_docdetail.assistant_id IN 	( $total_ids_query ) OR tax_docdetail.details_id IN	( $total_ids_query ) ) ";
		}


		if($data['assistant'])
		{
			$and[] = " tax_docdetail.assistant_id = $data[assistant] ";
		}


		if($data['startdate'])
		{
			$and[] = " tax_document.date >= '$data[startdate]' ";
			$where_date[] = " myTaxDoc.date >= '$data[startdate]' ";
		}

		if($data['enddate'])
		{
			$and[] = " tax_document.date <= '$data[enddate]' ";
			$where_date[] = " myTaxDoc.date <= '$data[enddate]' ";
		}


		if($data['details'])
		{
			$and[] = " tax_docdetail.details_id = $data[details] ";
		}

		if($data['status_verify'])
		{
			$and[] = " tax_document.status != 'draft' ";
			$where_date[] = " myTaxDoc.status != 'draft' ";
		}

		if($data['status_unverify'])
		{
			$and[] = " tax_document.status = 'draft' ";
			$where_date[] = " myTaxDoc.status = 'draft' ";
		}



		$query_string = \dash\validate::search($_query_string);

		if($query_string)
		{
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
			$order_sort = " ORDER BY tax_document.number ASC";
		}

		$list = \lib\db\tax_docdetail\search::list($and, $or, $order_sort, $meta, $where_date);

		if($data['summary_detail'])
		{
			$summary_list = \lib\db\tax_docdetail\search::summary_list($and, $or, $order_sort, $meta);
			self::$summary_detail = $summary_list;
		}


		if(!is_array($list))
		{
			$list = [];
		}

		$all_to_assistant = \lib\db\tax_coding\get::all_to_assistant();

		$coding_by_assistant = [];

		$all_to_assistant = array_combine(array_column($all_to_assistant, 'id'), $all_to_assistant);

		foreach ($all_to_assistant as $key => $value)
		{
			if(isset($value['type']) && $value['type'] === 'assistant')
			{
				if(!isset($coding_by_assistant[$value['id']]))
				{
					if(isset($value['parent1']) && isset($all_to_assistant[$value['parent1']]['title']))
					{
						$value['group_title'] = $all_to_assistant[$value['parent1']]['title'];
					}

					if(isset($value['parent2']) && isset($all_to_assistant[$value['parent2']]['title']))
					{
						$value['total_title'] = $all_to_assistant[$value['parent2']]['title'];
					}

					if(isset($value['title']))
					{
						$value['assistant_title'] = $value['title'];
					}

					$coding_by_assistant[$value['id']] = $value;
				}
			}
		}

		foreach ($list as $key => $value)
		{
			if(isset($value['assistant_id']))
			{
				if(isset($coding_by_assistant[$value['assistant_id']]))
				{
					if(isset($coding_by_assistant[$value['assistant_id']]['group_title']))
					{
						$list[$key]['group_title'] = $coding_by_assistant[$value['assistant_id']]['group_title'];
					}

					if(isset($coding_by_assistant[$value['assistant_id']]['total_title']))
					{
						$list[$key]['total_title'] = $coding_by_assistant[$value['assistant_id']]['total_title'];
					}

					if(isset($coding_by_assistant[$value['assistant_id']]['assistant_title']))
					{
						$list[$key]['assistant_title'] = $coding_by_assistant[$value['assistant_id']]['assistant_title'];
					}
				}
			}
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