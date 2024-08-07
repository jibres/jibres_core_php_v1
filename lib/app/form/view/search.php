<?php
namespace lib\app\form\view;


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
		\dash\permission::access('AdvanceFormAnalyze');

		$condition =
		[
			'order'   => 'order',
			'sort'    => ['enum' => ['id']],
			'type'    => ['enum' => ['assistant', 'group', 'total', 'details']],
			'form_id' => 'id',
		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and         = [];
		$meta        = [];
		$or          = [];

		$meta['limit'] = 20;
		// $meta['pagination'] = false;

		$order_sort  = null;



		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " form_view.id LIKE '%$query_string%' ";
			self::$is_filtered = true;
		}

		if($data['form_id'])
		{
			$and[] = " form_view.form_id = $data[form_id] ";
		}


		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['id']))
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
			$order_sort = " ORDER BY form_view.id ASC";
		}

		$list = \lib\db\form_view\search::list($and, $or, $order_sort, $meta);

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