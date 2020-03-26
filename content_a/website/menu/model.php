<?php
namespace content_a\website\menu;


class model
{
	public static function post()
	{
		$post =
		[
			'title'    => \dash\request::post('title'),
		];

		$theme_detail = \lib\app\menu\add::new_menu($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
