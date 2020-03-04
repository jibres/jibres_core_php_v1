<?php
namespace content_a\app\android\splash;

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

		$theme_detail = \lib\app\application\splash::set_android_theme($theme);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). '/intro');
			\dash\redirect::pwd();
		}
	}
}
?>
