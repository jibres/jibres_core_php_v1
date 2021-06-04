<?php
namespace content_b1\posts\fetch;


class view
{

	public static function config()
	{
		$args =
		[
			'order'   => \dash\request::get('order'),
			'sort'    => \dash\request::get('sort'),
			'status'  => \dash\request::get('status'),
			'subtype' => \dash\request::get('subtype'),
			'tag_id'  => \dash\request::get('tagid'),

			'pd'      => \dash\request::get('pd'),
			'g'       => \dash\request::get('g'),
			'fi'      => \dash\request::get('fi'),
			'co'      => \dash\request::get('co'),
			'seo'     => \dash\request::get('seo'),
			'sa'      => \dash\request::get('sa'),
			'com'     => \dash\request::get('com'),
			't'       => \dash\request::get('t'),
			'r'       => \dash\request::get('r'),
		];

		$result = \dash\app\posts\search::list(\dash\validate::search_string(), $args);

		$isFiltered = \dash\app\posts\search::is_filtered();
		\dash\notif::meta(['is_filtered' => $isFiltered]);

		\content_b1\tools::say($result);
	}

}
?>