<?php
namespace lib\app\form\tag;


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







	public static function list($_query_string = null, $_args = [])
	{

		\dash\permission::access('_group_form');


		$condition =
		[
			'order'      => 'order',
			'sort'       => ['enum' => ['title']],
			'pagination' => 'bit',
			'form_id'    => 'id',

		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and         = [];
		$meta        = [];
		$or          = [];

		$meta['limit'] = 20;
		if(array_key_exists('pagination', $_args) && $_args['pagination'] === false)
		{
			$meta['pagination'] = false;
		}

		$order_sort  = null;


		$query_string = \dash\validate::search($_query_string, false);


		if($query_string)
		{
			$or[]        = " form_tag.title LIKE '%$query_string%'";

			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			$sort = mb_strtolower($data['sort']);
			$order = null;
			if($data['order'])
			{
				$order = mb_strtolower($data['order']);
			}

			$order_sort = " ORDER BY $sort $order";
		}

		if($data['form_id'])
		{
			$and[] = " form_tag.form_id = $data[form_id] ";
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY form_tag.id DESC";
		}

		$list = \lib\db\form_tag\search::list($and, $or, $order_sort, $meta);


		if(is_array($list))
		{
			$list = array_map(['\\lib\\app\\tag\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

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