<?php
namespace content_a\website\menu;


class model
{
	public static function post()
	{
		if(\dash\request::post('removemenu'))
		{

			$post =
			[
				'removemenu'    => \dash\request::post('removemenu'),
				'removealllink' => \dash\request::post('removealllink'),
			];

			$theme_detail = \lib\app\website_menu\add::remove_menu($post);
		}
		else
		{

			$post =
			[
				'title'    => \dash\request::post('title'),
			];

			$theme_detail = \lib\app\website_menu\add::new_menu($post);

		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
