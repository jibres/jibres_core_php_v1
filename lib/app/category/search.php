<?php
namespace lib\app\category;


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


	public static function list_child($_category_id, $_string = null, $_args = [])
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if($_string)
		{
			$_string = \dash\safe::forQueryString($_string);
			if(mb_strlen($_string) > 50)
			{
				$_string = null;
			}
		}

		$_category_id = \dash\validate::id($_category_id);
		if(!$_category_id)
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$meta = [];

		$load_category = \lib\app\category\get::inline_get($_category_id);

		$parent_field = null;

		if(!isset($load_category['parent1']))
		{
			$parent_field    = 'parent1';
			$meta['parent2'] = null;
			$meta['parent3'] = null;
		}

		if(isset($load_category['parent1']) && $load_category['parent1'])
		{
			$parent_field    = 'parent2';
			$meta['parent3'] = null;
		}

		if(isset($load_category['parent2']) && $load_category['parent2'])
		{
			$parent_field = 'parent3';
		}

		if(isset($load_category['parent3']) && $load_category['parent3'])
		{
			\dash\notif::error(T_("This record is not childable"));
			return false;
		}

		if(!$parent_field)
		{
			\dash\notif::error(T_("This record have not child"));
			return false;
		}

		$result = \lib\db\productcategory\get::list_child($_category_id, $parent_field, $_string, $meta);

		$temp            = [];


		foreach ($result as $key => $value)
		{
			$check = \lib\app\category\ready::row($value);
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
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and         = [];
		$meta        = [];
		$or          = [];

		$meta['limit'] = 20;

		$order_sort  = null;


		$query_string = \dash\validate::search($_query_string);


		if($query_string)
		{
			$or[]        = " productcategory.title LIKE '%$query_string%'";

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
			$order_sort = " ORDER BY productcategory.id DESC";
		}

		$and[] = " productcategory.status != 'deleted' ";

		$list = \lib\db\productcategory\search::list($and, $or, $order_sort, $meta);


		if(is_array($list))
		{
			$list = array_map(['\\lib\\app\\category\\ready', 'row'], $list);
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