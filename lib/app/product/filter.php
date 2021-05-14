<?php
namespace lib\app\product;

class filter
{

	use \dash\datafilter;


	public static function sort_list_array($_module = null)
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


		return $sort_list;
	}



	private static function list_of_filter()
	{

		$list = [];

		$list['with_barcode'] =
		[
			'key'            => 'with_barcode',
			'group'          => T_("Barcode"),
			'title'          => T_("With Barcode"),
			'query'			 => ['bar' => 'y'],
			'public'         => false,
		];

		$list['without_barcode'] =
		[
			'key'            => 'without_barcode',
			'group'          => T_("Barcode"),
			'title'          => T_("Without Barcode"),
			'query'			 => ['bar' => 'n'],
			'public'         => false,
		];


		$list['with_buyprice'] =
		[
			'key'            => 'with_buyprice',
			'group'          => T_("Buyprice"),
			'title'          => T_("With Buyprice"),
			'query'			 => ['bup' => 'y'],
			'public'         => false,
		];

		$list['without_buyprice'] =
		[
			'key'            => 'without_buyprice',
			'group'          => T_("Buyprice"),
			'title'          => T_("Without Buyprice"),
			'query'			 => ['bup' => 'n'],
			'public'         => false,
		];


		$list['with_price'] =
		[
			'key'            => 'with_price',
			'group'          => T_("Price"),
			'title'          => T_("With Price"),
			'query'			 => ['p' => 'y'],
			'public'         => false,
		];

		$list['without_price'] =
		[
			'key'            => 'without_price',
			'group'          => T_("Price"),
			'title'          => T_("Without Price"),
			'query'			 => ['p' => 'n'],
			'public'         => false,
		];


		$list['with_discount'] =
		[
			'key'            => 'with_discount',
			'group'          => T_("Discount"),
			'title'          => T_("With Discount"),
			'query'			 => ['d' => 'y'],
			'public'         => false,
		];

		$list['without_discount'] =
		[
			'key'            => 'without_discount',
			'group'          => T_("Discount"),
			'title'          => T_("Without Discount"),
			'query'			 => ['d' => 'n'],
			'public'         => false,
		];


		$list['product_instork'] =
		[
			'key'            => 'product_instork',
			'group'          => T_("Stock"),
			'title'          => T_("Instock"),
			'query'			 => ['st' => 'y'],
			'public'         => false,
		];

		$list['product_outofinstork'] =
		[
			'key'            => 'product_outofinstork',
			'group'          => T_("Stock"),
			'title'          => T_("Out of stock"),
			'query'			 => ['st' => 'n'],
			'public'         => false,
		];

		$list['product_negrativeinventory'] =
		[
			'key'            => 'product_negrativeinventory',
			'group'          => T_("Stock"),
			'title'          => T_("Negative Inventory"),
			'query'			 => ['nst' => 'y'],
			'public'         => false,
		];


		$list['have_gallery'] =
		[
			'key'            => 'have_gallery',
			'group'          => T_("Gallery"),
			'title'          => T_("Have gallery"),
			'query'			 => ['g' => 'y'],
			'public'         => false,
		];


		$list['have_not_gallery'] =
		[
			'key'            => 'have_not_gallery',
			'group'          => T_("Gallery"),
			'title'          => T_("Have not gallery"),
			'query'			 => ['g' => 'n'],
			'public'         => false,
		];


		$list['have_variant'] =
		[
			'key'            => 'have_variant',
			'group'          => T_("Variant"),
			'title'          => T_("Have variants"),
			'query'			 => ['v' => 'y'],
			'public'         => false,
		];


		$list['have_not_variant'] =
		[
			'key'            => 'have_not_variant',
			'group'          => T_("Variant"),
			'title'          => T_("Have not variants"),
			'query'			 => ['v' => 'n'],
			'public'         => false,
		];


		$list['have_sold'] =
		[
			'key'            => 'have_sold',
			'group'          => T_("Sold"),
			'title'          => T_("Have sold"),
			'query'			 => ['so' => 'y'],
			'public'         => false,
		];


		$list['have_not_sold'] =
		[
			'key'            => 'have_not_sold',
			'group'          => T_("Sold"),
			'title'          => T_("Have not sold"),
			'query'			 => ['so' => 'n'],
			'public'         => false,
		];

		$list['tracking_on'] =
		[
			'key'            => 'tracking_on',
			'group'          => T_("Track quantity"),
			'title'          => T_("Track quantity On"),
			'query'			 => ['tq' => 'y'],
			'public'         => false,
		];


		$list['tracking_off'] =
		[
			'key'            => 'tracking_off',
			'group'          => T_("Track quantity"),
			'title'          => T_("Track quantity Off"),
			'query'			 => ['tq' => 'n'],
			'public'         => false,
		];


		$list['have_weight'] =
		[
			'key'            => 'have_weight',
			'group'          => T_("Weight"),
			'title'          => T_("Have weight"),
			'query'			 => ['w' => 'y'],
			'public'         => false,
		];


		$list['have_not_weight'] =
		[
			'key'            => 'have_not_weight',
			'group'          => T_("Weight"),
			'title'          => T_("Have not weight"),
			'query'			 => ['w' => 'n'],
			'public'         => false,
		];


		$list['have_tag'] =
		[
			'key'            => 'have_tag',
			'group'          => T_("Tag"),
			'title'          => T_("Have tag"),
			'query'			 => ['t' => 'y'],
			'public'         => false,
		];


		$list['have_not_tag'] =
		[
			'key'            => 'have_not_tag',
			'group'          => T_("Tag"),
			'title'          => T_("Have not tag"),
			'query'			 => ['t' => 'n'],
			'public'         => false,
		];


		$list['duplicate_title'] =
		[
			'key'            => 'duplicate_title',
			'group'          => T_("Duplicate Title"),
			'title'          => T_("Duplicate Title"),
			'query'			 => ['dup' => 1],
			'public'         => false,
		];



		$list['product_tag_search'] =
		[
			'key'    => 'product_tag_search',
			'group'  => T_("Tag"),
			'title'  => T_("Search in product tag"),
			'mode'   => 'product_tag_search',
			'public' => false,
		];


		$list['product_unit_search'] =
		[
			'key'    => 'product_unit_search',
			'group'  => T_("Unit"),
			'title'  => T_("Search in product unit"),
			'mode'   => 'product_unit_search',
			'public' => false,
		];


		$list['product_status_search'] =
		[
			'key'    => 'product_status_search',
			'group'  => T_("Status"),
			'title'  => T_("Search in product staus"),
			'mode'   => 'product_status_search',
			'public' => false,
		];



		return $list;

	}

}
?>