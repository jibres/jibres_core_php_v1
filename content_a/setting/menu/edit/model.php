<?php
namespace content_a\setting\menu\edit;


class model
{
	public static function post()
	{
		$post =
		[
			'title'    => \dash\request::post('menutitle'),
		];

		$theme_detail = \lib\app\menu\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
