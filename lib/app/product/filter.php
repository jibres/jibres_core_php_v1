<?php
namespace lib\app\product;

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
		// $sort_list[] = ['title' => T_("None"), 				'query' => [], 												'public' => true];
		$sort_list[] = ['title' => T_("Title ASC"), 		'query' => ['sort' => 'title',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Title DESC"), 		'query' => ['sort' => 'title',		 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Expensive"), 		'query' => ['sort' => 'finalprice',		 'order' => 'desc'], 	'public' => true];
		$sort_list[] = ['title' => T_("Inexpensive"), 		'query' => ['sort' => 'finalprice',		 'order' => 'asc'], 	'public' => true];

		if($_module === 'website')
		{
			// nothing
		}
		else
		{
			$sort_list[] = ['title' => T_("Buy price ASC"), 	'query' => ['sort' => 'buyprice',	 'order' => 'asc'], 	'public' => false];
			$sort_list[] = ['title' => T_("Buy price DESC"), 	'query' => ['sort' => 'buyprice',	 'order' => 'desc'], 	'public' => false];
		}


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

}
?>