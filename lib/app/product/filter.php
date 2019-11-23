<?php
namespace lib\app\product;

class filter
{

	// get public sort list for api and application
	public static function public_sort_list($_module = null)
	{
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


	public static function check_allow($_sort, $_order)
	{
		$order = mb_strtolower($_order);
		if($order && in_array($order, ['asc', 'desc']))
		{
			$sort = mb_strtolower($_sort);
			if($sort)
			{
				$list     = self::sort_list(true);
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
		$sort_list[] = ['title' => T_("Expensive"), 		'query' => ['sort' => 'price',		 'order' => 'desc'], 	'public' => true];
		$sort_list[] = ['title' => T_("Inexpensive"), 		'query' => ['sort' => 'price',		 'order' => 'asc'], 	'public' => true];

		$sort_list[] = ['title' => T_("Title ASC"), 		'query' => ['sort' => 'title',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Title DESC"), 		'query' => ['sort' => 'title',		 'order' => 'desc'], 	'public' => false];

		if($_module === 'price' || $_module === true)
		{
			$sort_list[] = ['title' => T_("Buy price ASC"), 	'query' => ['sort' => 'buyprice',	 'order' => 'asc'], 	'public' => false];
			$sort_list[] = ['title' => T_("Buy price DESC"), 	'query' => ['sort' => 'buyprice',	 'order' => 'desc'], 	'public' => false];
		}


		foreach ($sort_list as $key => $value)
		{
			$sort_list[$key]['query_string'] = http_build_query($value['query']);
		}

		return $sort_list;
	}

}
?>