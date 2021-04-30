<?php
namespace content_a\pagebuilder\add;


class model
{
	public static function post()
	{
		$post =
		[
			'title' => \dash\request::post('title'),
			'type'  => 'pagebuilder',
		];

		$post_detail = \dash\app\posts\add::add($post, true);

		if(\dash\engine\process::status() && isset($post_detail['post_id']))
		{
			\dash\redirect::to(\dash\url::this(). '/build?id='. $post_detail['post_id']);
			return;
		}
	}
}
?>