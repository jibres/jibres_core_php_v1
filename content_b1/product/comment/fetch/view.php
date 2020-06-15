<?php
namespace content_b1\product\comment\fetch;


class view
{
	public static function config()
	{
		$id = \dash\request::get('product');

		$search_string            = \dash\request::get('q');

		$args =
		[
			'sort'  => \dash\request::get('sort'),
			'order' => \dash\request::get('order'),
			'status' => \dash\request::get('status'),
			'product_id' => $id,
		];

		$dataTable = \lib\app\product\comment::list($search_string, $args);

		$isFiltered = \lib\app\product\comment::is_filtered();
		$filter_message = \lib\app\product\comment::filter_message();

		\dash\notif::meta(['is_filtered' => $isFiltered, 'filter_message' => $filter_message]);

		\content_b1\tools::say($dataTable);

	}


}
?>