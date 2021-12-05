<?php
namespace lib\app\form\answerdetail;


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


	public static function list($_query_string, $_args, $_hot_query = [])
	{
		\dash\permission::access('_group_form');

		$condition =
		[
			'order'      => 'order',
			'sort'       => ['enum' => ['title', 'id']],
			'type'       => ['enum' => ['assistant', 'group', 'total', 'details']],
			'answer_id'  => 'id',
			'form_id'    => 'id',
			'item_id'    => 'id',
			'export'     => 'bit',
			'filter_id'  => 'id',
			'table_name' => 'string_100',
			'get_count'  => 'bit',
		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and         = [];
		$meta        = [];
		$or          = [];

		$meta['limit'] = 50;
		if($data['export'])
		{
			$meta['pagination'] = false;
		}

		$order_sort  = null;


		if($data['filter_id'] && $data['table_name'])
		{
			$where_list = \lib\app\form\filter\get::where_list($data['filter_id'], $data['form_id']);


			if($where_list && is_array($where_list))
			{
				$answer_id_in = [];
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

						$answer_id_in[] = $temp;

					}

				}

				if($_hot_query && is_array($_hot_query))
				{
					foreach ($_hot_query as $hv)
					{
						$answer_id_in[] = $hv;
					}
				}

				$answer_id_in = " form_answerdetail.answer_id IN ( SELECT $data[table_name].f_answer_id FROM $data[table_name] WHERE ". implode(' AND ', $answer_id_in). ')';

				$and[] = $answer_id_in;
			}
		}


		if($data['answer_id'])
		{
			$and[] = " form_answerdetail.answer_id = $data[answer_id] ";
		}

		if($data['form_id'])
		{
			$and[] = " form_answerdetail.form_id = $data[form_id] ";
		}

		if($data['item_id'])
		{
			$and[] = " form_answerdetail.item_id = $data[item_id] ";
		}


		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " form_answerdetail.answer LIKE '%$query_string%' ";
			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['datecreated']))
			{
				$sort = \dash\str::mb_strtolower($data['sort']);
				$order = null;
				if($data['order'])
				{
					$order = \dash\str::mb_strtolower($data['order']);
				}

				$order_sort = " ORDER BY $sort $order";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY form_answerdetail.id ASC";
		}

		if($data['get_count'])
		{
			$list = \lib\db\form_answerdetail\search::list_count($and, $or, $order_sort, $meta);
			return floatval($list);

		}
		else
		{
			$list = \lib\db\form_answerdetail\search::list($and, $or, $order_sort, $meta);
		}

		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['\\lib\\app\\form\\answer\\ready', 'row'], $list);

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