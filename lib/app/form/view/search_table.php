<?php
namespace lib\app\form\view;


class search_table
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


	public static function list($_query_string, $_args, $_hot_query = [])
	{

		$condition =
		[
			'order'       => 'order',
			'sort'        => ['enum' => ['id']],
			'type'        => ['enum' => ['assistant', 'group', 'total', 'details']],
			'table_name'  => 'string_200',
			'filter_id'   => 'id',
			'form_id'     => 'id',
			'f_answer_id'     => 'id',
			'export'      => 'bit',
			'start_limit' => 'int',
			'limit'       => 'int',
			'get_count' => 'bit',
		];

		$require = ['table_name'];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and         = [];
		$meta        = [];
		$or          = [];

		$meta['limit'] = 20;

		if($data['export'])
		{
			$meta['pagination'] = false;
		}

		if($data['start_limit'])
		{
			$meta['start_limit'] = $data['start_limit'];
		}

		if($data['limit'])
		{
			$meta['limit'] = $data['limit'];
		}


		if($data['f_answer_id'])
		{
			$and[] = " `$data[table_name]`.f_answer_id = $data[f_answer_id] ";
			$meta['pagination'] = false;
		}

		if($data['filter_id'])
		{
			$where_list = \lib\app\form\filter\get::where_list($data['filter_id'], $data['form_id']);

			if($where_list && is_array($where_list))
			{
				foreach ($where_list as $key => $value)
				{
					if(isset($value['query_condition']))
					{
						$temp = " `$data[table_name]`.$value[field] $value[query_condition] ";
						if(isset($value['value']) && $value['value'])
						{
							if($value['query_condition'] === 'LIKE')
							{
								$temp .= " '$value[value]%' ";
							}
							else
							{
								$temp .= " '$value[value]' ";
							}
						}

						self::$is_filtered = true;
						$and[] = $temp;
					}
				}

				if($_hot_query && is_array($_hot_query))
				{
					foreach ($_hot_query as $hv)
					{
						$and[] = $hv;
					}
				}
			}
		}


		$order_sort  = null;



		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			// $or[] = " form_view.id LIKE '%$query_string%' ";
			self::$is_filtered = true;
		}

		// if($data['form_id'])
		// {
		// 	$and[] = " form_view.form_id = $data[form_id] ";
		// }


		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['id']))
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
			$order_sort = " ORDER BY $data[table_name].id ASC";
		}

		if($data['get_count'])
		{
			$list = \lib\db\form_view\search_table::list_count($data['table_name'], $and, $or, $order_sort, $meta);
			return floatval($list);
		}
		else
		{
			$list = \lib\db\form_view\search_table::list($data['table_name'], $and, $or, $order_sort, $meta);
		}

		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['\\lib\\app\\form\\view\\ready', 'row'], $list);

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