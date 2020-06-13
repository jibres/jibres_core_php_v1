<?php
namespace content_b1\product\fetch;


class view
{
	public static function config()
	{
		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'filter' => [],
		];

		$search_query = \dash\request::get('q');

		$myProductList  = \lib\app\product\search::variant_list($search_query, $args);
		$filter_message = \lib\app\product\search::filter_message();
		$isFiltered     = \lib\app\product\search::is_filtered();

		\content_b1\tools::say($myProductList);
	}
}
?>