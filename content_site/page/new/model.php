<?php
namespace content_site\page\new;


class model extends model_new
{
	public static function post_old()
	{
		$post =
		[
			'title'  => \dash\request::post('title'),
			'type'   => 'pagebuilder',
			'status' => 'publish',
		];

		$have_any_pagebuilder = \dash\app\posts\get::have_any_pagebuilder();

		$post_detail = \dash\app\posts\add::add($post, true);

		if(\dash\engine\process::status() && isset($post_detail['post_id']))
		{
			if(!$have_any_pagebuilder)
			{
				\content_site\homepage::set_as_homepage($post_detail['post_id']);
			}

			\dash\notif::clean();
			\dash\notif::ok(T_("Page successfully created"));
			\dash\redirect::to(\dash\url::this(). '?id='. $post_detail['post_id']);
			return;
		}
	}
}
?>