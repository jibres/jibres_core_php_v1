<?php
namespace content_b1\ticket\fetch;


class view
{
	public static function config()
	{

		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'status' => \dash\request::get('status'),
			'so'     => \dash\request::get('so'),
			'user'   => \dash\request::get('user'),

		];

		$search_string = \dash\validate::search_string();

		$list = \dash\app\ticket\search::list($search_string, $args);

		$isFiltered = \dash\app\ticket\search::is_filtered();
		\dash\notif::meta(['is_filtered' => $isFiltered]);

		\content_b1\tools::say($list);
	}



}
?>