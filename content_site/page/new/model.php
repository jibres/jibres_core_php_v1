<?php
namespace content_site\page\new;


class model
{
	public static function post()
	{
		$post =
		[
			'title'  => \dash\request::post('title'),
			'type'   => 'pagebuilder',
			'status' => 'publish',
		];

		$post_detail = \dash\app\posts\add::add($post, true);

		if(\dash\engine\process::status() && isset($post_detail['post_id']))
		{
			\dash\notif::clean();
			\dash\notif::ok(T_("Page successfully created"));
			\dash\redirect::to(\dash\url::this(). '?id='. $post_detail['post_id']);
			return;
		}
	}
}
?>