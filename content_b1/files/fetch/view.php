<?php
namespace content_b1\files\fetch;


class view
{

	public static function config()
	{
		$args =
		[
			'order'      => \dash\request::get('order'),
			'sort'       => \dash\request::get('sort'),
		];

		$result      = \dash\app\files\search::list(\dash\validate::search_string(), $args);

		\dash\notif::meta(['is_filtered' => \dash\app\files\search::is_filtered()]);

		\content_b1\tools::say($result);
	}
}
?>