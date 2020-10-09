<?php
namespace content_cms\posts\add;


class model
{
	public static function post()
	{

		$post =
		[
			'title'       => \dash\request::post('title'),
			'language'    => \dash\language::current(),
			'content'     => \dash\request::post_raw('content'),
		];


		if(\dash\request::get('type'))
		{
			$post['type'] = \dash\request::get('type');
		}

		$post_detail = \dash\app\posts::add($post);

		if(\dash\engine\process::status() && isset($post_detail['post_id']))
		{
			\dash\redirect::to(\dash\url::here(). '/posts/edit?id='. $post_detail['post_id']);
			return;
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
