<?php
namespace content_a\app\android\logo;

class model
{
	public static function post()
	{
		$theme_detail = \lib\app\application\detail::set_android_logo();

		if(\dash\engine\process::status())
		{
			if(\dash\request::get('setup') === 'wizard')
			{
				\dash\redirect::to(\dash\url::that().'/apk');
			}
			else
			{
				\dash\redirect::pwd();
			}
		}
	}
}
?>
