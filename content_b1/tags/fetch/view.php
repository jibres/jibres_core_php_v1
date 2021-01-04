<?php
namespace content_b1\tags\fetch;


class view
{

	public static function config()
	{
		$args =
		[
			'order'      => \dash\request::get('order'),
			'sort'       => \dash\request::get('sort'),

		];

		$result      = \dash\app\terms\search::list(\dash\request::get('q'), $args);

		\dash\notif::meta(['is_filtered' => \dash\app\terms\search::is_filtered()]);

		\content_b1\tools::say($result);
	}
}
?>