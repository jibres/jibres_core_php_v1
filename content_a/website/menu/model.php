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
			];

			$theme_detail = \lib\app\menu\add::remove_menu($post);
		}
		else
		{

			$post =
			[
				'title'    => \dash\request::post('title'),
			];

			$theme_detail = \lib\app\menu\add::new_menu($post);

		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
