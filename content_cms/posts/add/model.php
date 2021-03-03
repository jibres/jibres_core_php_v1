<?php
namespace content_cms\posts\add;


class model
{
	public static function post()
	{

		if(\content_cms\posts\edit\model::upload_editor())
		{
			return false;
		}

		$post =
		[
			'title'    => \dash\request::post('title'),
			'subtype'  => \dash\request::post('subtype'),
			'content'  => \dash\request::post_raw('html'),
			'language' => \dash\language::current(),
		];

		$post_detail = \dash\app\posts\add::add($post);

		if(\dash\engine\process::status() && isset($post_detail['post_id']))
		{
			// set file usage record if upload in editor
			\dash\app\files\update::set_post_fileuseage_editor($post_detail['post_id']);

			\dash\redirect::to(\dash\url::this(). '/edit?id='. $post_detail['post_id']);
			return;
		}
	}
}
?>
