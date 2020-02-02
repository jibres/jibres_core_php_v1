<?php
namespace content_a\app\intro;

class model
{
	public static function post()
	{
		$theme = \dash\request::post('theme');

		if(!$theme)
		{
			\dash\notif::warn(T_("Please choose your theme"));
			return false;
		}

		$theme_detail = \lib\app\application\theme::set($theme);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
