<?php
namespace content_b1\product\fetch;


class view
{
	public static function config()
	{
		$args =
		[
			'order'             => \dash\request::get('order'),
			'sort'              => \dash\request::get('sort'),
			'included_category' => \dash\request::get('included_category'),
		];

		$barcode = \dash\request::get('barcode');
		if($barcode)
		{
			$args['barcode'] = $barcode;
		}

		$search_query = \dash\validate::search_string();

		$myProductList  = \lib\app\product\search::variant_list($search_query, $args);
		$filter_message = \lib\app\product\search::filter_message();
		$isFiltered     = \lib\app\product\search::is_filtered();

		\dash\notif::meta(['is_filtered' => $isFiltered, 'filter_message' => $filter_message]);

		\content_b1\tools::say($myProductList);
	}
}
?>