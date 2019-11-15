<?php
namespace content_api\v2\product;


class get
{
	public static function route()
	{
		if(\dash\request::is('get'))
		{
			return self::get();
		}
		else
		{
			\content_api\v2::stop(405);
		}
	}

	private static function get()
	{

		$args =
		[
			'order'        => \dash\request::get('order'),
			'sort'         => \dash\request::get('sort'),
			'barcode'      => \dash\request::get('barcode'),
			'filter'       => [],
		];

		if(\dash\request::get('duplicatetitle')) $args['filter']['duplicatetitle']   = true;
		if(\dash\request::get('hbarcode')) 		 $args['filter']['hbarcode'] 		 = true;
		if(\dash\request::get('hnotbarcode')) 	 $args['filter']['hnotbarcode'] 	 = true;
		if(\dash\request::get('wbuyprice')) 	 $args['filter']['wbuyprice'] 	 	 = true;
		if(\dash\request::get('wprice')) 		 $args['filter']['wprice'] 		 	 = true;
		if(\dash\request::get('wdiscount')) 	 $args['filter']['wdiscount'] 	 	 = true;

		$search_string = \dash\request::get('q');

		$myProductList = \lib\app\product\search::variant_list($search_string, $args);

		return $myProductList;
	}
}
?>