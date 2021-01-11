<?php
namespace content_a\website\menu\item;


class model
{
	public static function post()
	{
		$post =
		[
			'title'         => \dash\request::post('title'),
			'url'           => \dash\request::post('url'),
			'pointer'       => \dash\request::post('pointer'),
			'target'        => \dash\request::post('target'),
			'product_id'    => \dash\request::post('product_id'),
			'post_id'       => \dash\request::post('post_id'),
			'tag_id'        => \dash\request::post('tag_id'),
			'socialnetwork' => \dash\request::post('socialnetwork'),
			'hashtag_id'    => \dash\request::post('tag_id'),
		];

		$theme_detail = \lib\app\menu\add::menu_item($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). '/roster'. \dash\request::full_get(['key' => null]));
		}
	}

}
?>