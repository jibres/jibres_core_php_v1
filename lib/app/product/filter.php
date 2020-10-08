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
		$sort_list[] = ['title' => T_("Maximum discount"), 		'query' => ['sort' => 'discount',		 'order' => 'desc'], 	'public' => true];

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

			$query_string = null;
			if(isset($value['run_by_another']) && $value['run_by_another'])
			{
				$query_string = \dash\request::fix_get($value['query']);
			}
			else
			{
				$query_string = \dash\request::build_query($value['query']);
			}

			$list[$key]['query_string'] = $query_string;
			$list[$key]['is_active'] = $active;
		}

		return $list;
	}


	private static function list_of_filter()
	{

		$list = [];

		$list['duplicate_title'] =
		[
			'key'            => 'duplicate_title',
			'group'          => T_("Duplicate Title"),
			'title'          => T_("Duplicate Title"),
			'query'			 => ['dup' => 1],
			'public'         => false,
			'run_by_another' => false,
		];

		$list['with_barcode'] =
		[
			'key'            => 'with_barcode',
			'group'          => T_("Barcode"),
			'title'          => T_("With Barcode"),
			'query'			 => ['bar' => 'y'],
			'public'         => false,
			'run_by_another' => true,
		];

		$list['without_barcode'] =
		[
			'key'            => 'without_barcode',
			'group'          => T_("Barcode"),
			'title'          => T_("Without Barcode"),
			'query'			 => ['bar' => 'n'],
			'public'         => false,
			'run_by_another' => true,
		];


		$list['with_buyprice'] =
		[
			'key'            => 'with_buyprice',
			'group'          => T_("Buyprice"),
			'title'          => T_("With Buyprice"),
			'query'			 => ['bup' => 'y'],
			'public'         => false,
			'run_by_another' => true,
		];

		$list['without_buyprice'] =
		[
			'key'            => 'without_buyprice',
			'group'          => T_("Buyprice"),
			'title'          => T_("Without Buyprice"),
			'query'			 => ['bup' => 'n'],
			'public'         => false,
			'run_by_another' => true,
		];


		$list['with_price'] =
		[
			'key'            => 'with_price',
			'group'          => T_("Price"),
			'title'          => T_("With Price"),
			'query'			 => ['p' => 'y'],
			'public'         => false,
			'run_by_another' => true,
		];

		$list['without_price'] =
		[
			'key'            => 'without_price',
			'group'          => T_("Price"),
			'title'          => T_("Without Price"),
			'query'			 => ['p' => 'n'],
			'public'         => false,
			'run_by_another' => true,
		];


		$list['with_discount'] =
		[
			'key'            => 'with_discount',
			'group'          => T_("Discount"),
			'title'          => T_("With Discount"),
			'query'			 => ['d' => 'y'],
			'public'         => false,
			'run_by_another' => true,
		];

		$list['without_discount'] =
		[
			'key'            => 'without_discount',
			'group'          => T_("Discount"),
			'title'          => T_("Without Discount"),
			'query'			 => ['d' => 'n'],
			'public'         => false,
			'run_by_another' => true,
		];


		$list['product_instork'] =
		[
			'key'            => 'product_instork',
			'group'          => T_("Stock"),
			'title'          => T_("Instock"),
			'query'			 => ['st' => 'y'],
			'public'         => false,
			'run_by_another' => true,
		];

		$list['product_outofinstork'] =
		[
			'key'            => 'product_outofinstork',
			'group'          => T_("Stock"),
			'title'          => T_("Out of stock"),
			'query'			 => ['st' => 'n'],
			'public'         => false,
			'run_by_another' => true,
		];

		$list['product_negrativeinventory'] =
		[
			'key'            => 'product_negrativeinventory',
			'group'          => T_("Stock"),
			'title'          => T_("Negative Inventory"),
			'query'			 => ['nst' => 'y'],
			'public'         => false,
			'run_by_another' => true,
		];


		$list['have_gallery'] =
		[
			'key'            => 'have_gallery',
			'group'          => T_("Gallery"),
			'title'          => T_("Have gallery"),
			'query'			 => ['g' => 'y'],
			'public'         => false,
			'run_by_another' => true,
		];


		$list['have_not_gallery'] =
		[
			'key'            => 'have_not_gallery',
			'group'          => T_("Gallery"),
			'title'          => T_("Have not gallery"),
			'query'			 => ['g' => 'n'],
			'public'         => false,
			'run_by_another' => true,
		];


		$list['have_variant'] =
		[
			'key'            => 'have_variant',
			'group'          => T_("Variant"),
			'title'          => T_("Have variants"),
			'query'			 => ['v' => 'y'],
			'public'         => false,
			'run_by_another' => true,
		];


		$list['have_not_variant'] =
		[
			'key'            => 'have_not_variant',
			'group'          => T_("Variant"),
			'title'          => T_("Have not variants"),
			'query'			 => ['v' => 'n'],
			'public'         => false,
			'run_by_another' => true,
		];


		$list['have_sold'] =
		[
			'key'            => 'have_sold',
			'group'          => T_("Sold"),
			'title'          => T_("Have sold"),
			'query'			 => ['so' => 'y'],
			'public'         => false,
			'run_by_another' => true,
		];


		$list['have_not_sold'] =
		[
			'key'            => 'have_not_sold',
			'group'          => T_("Sold"),
			'title'          => T_("Have not sold"),
			'query'			 => ['so' => 'n'],
			'public'         => false,
			'run_by_another' => true,
		];


		$list['have_weight'] =
		[
			'key'            => 'have_weight',
			'group'          => T_("Weight"),
			'title'          => T_("Have weight"),
			'query'			 => ['w' => 'y'],
			'public'         => false,
			'run_by_another' => true,
		];


		$list['have_not_weight'] =
		[
			'key'            => 'have_not_weight',
			'group'          => T_("Weight"),
			'title'          => T_("Have not weight"),
			'query'			 => ['w' => 'n'],
			'public'         => false,
			'run_by_another' => true,
		];


		$list['have_tag'] =
		[
			'key'            => 'have_tag',
			'group'          => T_("Tag"),
			'title'          => T_("Have tag"),
			'query'			 => ['t' => 'y'],
			'public'         => false,
			'run_by_another' => true,
		];


		$list['have_not_tag'] =
		[
			'key'            => 'have_not_tag',
			'group'          => T_("Tag"),
			'title'          => T_("Have not tag"),
			'query'			 => ['t' => 'n'],
			'public'         => false,
			'run_by_another' => true,
		];



		// $list['collection'] =
		// [
		// 	'key'            => 'collection',
		// 	'group'          => T_("Collection"),
		// 	'title'          => T_("Collection"),
		// 	'query'			 => [],
		// 	'public'         => false,
		// 	'run_by_another' => true,
		// ];


		// $list['unit'] =
		// [
		// 	'key'            => 'unit',
		// 	'group'          => T_("Collection"),
		// 	'title'          => T_("Collection"),
		// 	'query'			 => [],
		// 	'public'         => false,
		// 	'run_by_another' => true,
		// ];

		// $list['company'] =
		// [
		// 	'key'            => 'company',
		// 	'group'          => T_("Collection"),
		// 	'title'          => T_("Collection"),
		// 	'query'			 => [],
		// 	'public'         => false,
		// 	'run_by_another' => true,
		// ];

		return $list;

	}

}
?>