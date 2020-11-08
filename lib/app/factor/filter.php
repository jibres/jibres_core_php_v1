<?php
namespace lib\app\factor;

class filter
{

	// get public sort list for api and application
	public static function public_sort_list($_module = null)
	{
		$_module = \dash\validate::string($_module);
		$list = self::sort_list($_module);
		$public_sort_list = [];
		foreach ($list as $key => $value)
		{
			if(isset($value['public']) && $value['public'])
			{
				$public_sort_list[] = $value;
			}
		}

		return $public_sort_list;
	}


	public static function check_allow($_sort, $_order, $_module = null)
	{
		$order = mb_strtolower($_order);
		if($order && in_array($order, ['asc', 'desc']))
		{
			$sort = mb_strtolower($_sort);
			if($sort)
			{
				$list     = self::sort_list($_module);
				$query    = array_column($list, 'query');
				$sort_key = array_column($query, 'sort');

				if(in_array($sort, $sort_key))
				{
					return true;
				}
			}
		}

		return false;
	}



	public static function sort_list($_module = null)
	{

		// public => true means show in api and site
		$sort_list   = [];
		$sort_list[] = ['title' => T_("Sort"), 				'query' => ['sort' => null, 		 'order' => null], 		'public' => false];
		$sort_list[] = ['title' => T_("Date ASC"), 			'query' => ['sort' => 'date',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Date DESC"), 		'query' => ['sort' => 'date',		 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Total ASC"), 		'query' => ['sort' => 'subtotal',	 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Total DESC"), 		'query' => ['sort' => 'subtotal',	 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Discount ASC"), 		'query' => ['sort' => 'subdiscount', 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Discount DESC"), 	'query' => ['sort' => 'subdiscount', 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Price ASC"), 		'query' => ['sort' => 'subprice',	 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Price DESC"), 		'query' => ['sort' => 'subprice',	 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Item ASC"), 			'query' => ['sort' => 'item',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Item DESC"), 		'query' => ['sort' => 'item',		 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Qty ASC"), 			'query' => ['sort' => 'qty',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Qty DESC"), 			'query' => ['sort' => 'qty',		 'order' => 'desc'], 	'public' => false];


		$current_string_query = \dash\request::get();
		unset($current_string_query['sort']);
		unset($current_string_query['order']);

		foreach ($sort_list as $key => $value)
		{
			$myQuery = [];
			$myQuery = array_merge($value['query'], $current_string_query);
			$sort_list[$key]['query_string'] = http_build_query($myQuery);
		}

		return $sort_list;
	}


	public static function list()
	{
		$list = self::list_of_filter();

		$get = \dash\request::get();

		foreach ($list as $key => $value)
		{
			$active = false;
			foreach ($value['query'] as $k => $v)
			{
				if(isset($get[$k]) && $get[$k] == $v)
				{
					$active = true;
					break;
				}
			}

			if($active)
			{
				$myQuery      = array_map(function($_a) {return null;}, $value['query']);
				$query_string = \dash\request::fix_get($myQuery);
			}
			else
			{
				$query_string = \dash\request::fix_get($value['query']);
			}

			$list[$key]['query_string'] = $query_string;
			$list[$key]['is_active']    = $active;
		}

		return $list;
	}


	private static function list_of_filter()
	{

		$list = [];



		$list['pay'] =
		[
			'key'            => 'pay',
			'group'          => T_("Pay"),
			'title'          => T_("Payed"),
			'query'			 => ['pay' => 'y'],
			'public'         => false,
		];

		$list['not_pay'] =
		[
			'key'            => 'not_pay',
			'group'          => T_("Pay"),
			'title'          => T_("Not payed"),
			'query'			 => ['pay' => 'n'],
			'public'         => false,
		];




		return $list;

	}

}
?>