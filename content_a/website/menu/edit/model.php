<?php
namespace content_a\website\menu\edit;


class model
{
	public static function post()
	{
		$post =
		[
			'title'   => \dash\request::post('title'),
			'url'     => \dash\request::post('url'),
			'target'  => \dash\request::post('target'),
			'sort'    => \dash\request::post('sort'),
			'itemkey' => \dash\request::post('itemkey'),
			'remove'  => \dash\request::post('remove'),
		];

		$theme_detail = \lib\app\menu\add::menu_item($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
