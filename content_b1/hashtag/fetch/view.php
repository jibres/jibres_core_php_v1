<?php
namespace content_b1\hashtag\fetch;


class view
{

	public static function config()
	{
		$args =
		[
			'order'      => \dash\request::get('order'),
			'sort'       => \dash\request::get('sort'),

		];

		$result      = \dash\app\terms\search::list(\dash\validate::search_string(), $args);

		\dash\notif::meta(['is_filtered' => \dash\app\terms\search::is_filtered()]);

		\content_b1\tools::say($result);
	}
}
?>