<?php
namespace lib\app\tag;


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


	public static function list_child($_tag_id, $_string = null, $_args = [])
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if($_string)
		{
			$_string = \dash\validate::search($_string, false);
		}

		$_tag_id = \dash\validate::id($_tag_id);
		if(!$_tag_id)
		{
			\dash\notif::error(T_("Invalid tag id"));
			return false;
		}

		$meta = [];

		$load_tag = \lib\app\tag\get::inline_get($_tag_id);

		$parent_field = null;

		if(!isset($load_tag['parent1']))
		{
			$parent_field    = 'parent1';
			$meta['parent2'] = null;
			$meta['parent3'] = null;
		}

		if(isset($load_tag['parent1']) && $load_tag['parent1'])
		{
			$parent_field    = 'parent2';
			$meta['parent3'] = null;
		}

		if(isset($load_tag['parent2']) && $load_tag['parent2'])
		{
			$parent_field = 'parent3';
		}

		if(isset($load_tag['parent3']) && $load_tag['parent3'])
		{
			\dash\notif::error(T_("This record is not childable"));
			return false;
		}

		if(!$parent_field)
		{
			\dash\notif::error(T_("This record have not child"));
			return false;
		}

		$result = \lib\db\producttag\get::list_child($_tag_id, $parent_field, $_string, $meta);

		$temp            = [];


		foreach ($result as $key => $value)
		{
			$check = \lib\app\tag\ready::row($value);
			if($check)
			{
				$temp[] = $check;
			}
		}
		// j($temp);
		return $temp;
	}





	public static function list($_query_string = null, $_args = [])
	{
		$condition =
		[
			'order'          => 'order',
			'sort'           => ['enum' => ['title']],
			'pagination' => 'bit',

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
			$or[]        = " producttag.title LIKE '%$query_string%'";

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

		if(!$order_sort)
		{
			$order_sort = " ORDER BY producttag.id DESC";
		}

		$list = \lib\db\producttag\search::list($and, $or, $order_sort, $meta);


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