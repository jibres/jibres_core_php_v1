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
			if(\dash\request::get('setup') === 'wizard')
			{
				\dash\redirect::to(\dash\url::that(). '/intro?setup=wizard');
			}
			else
			{
				\dash\redirect::pwd();
			}

		}
	}
}
?>
