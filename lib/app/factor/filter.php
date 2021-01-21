<?php
namespace lib\app\factor;

class filter
{

	use \dash\datafilter;

	public static function sort_list_array($_module = null)
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



		return $sort_list;
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