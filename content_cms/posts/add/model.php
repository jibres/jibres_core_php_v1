<?php
namespace content_cms\posts\add;


class model
{
	public static function post()
	{
		$post =
		[
			'title'   => \dash\request::post('title'),
			'content' => \dash\request::post_raw('content'),
		];

		$post_detail = \dash\app\posts\add::add($post);

		if(\dash\engine\process::status() && isset($post_detail['post_id']))
		{
			\dash\redirect::to(\dash\url::this(). '/edit?id='. $post_detail['post_id']);
			return;
		}
	}
}
?>
