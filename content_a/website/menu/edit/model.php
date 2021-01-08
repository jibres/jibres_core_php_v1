<?php
namespace content_a\website\menu\edit;


class model
{
	public static function post()
	{
		$post =
		[
			'title'    => \dash\request::post('menutitle'),
		];

		$theme_detail = \lib\app\website\menu\edit::edit_menu($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
