<?php
namespace content_a\app\android\splash;

class model
{
	public static function post()
	{
		$post              = [];
		$post['theme']     = \dash\request::post('theme');
		$post['start']     = \dash\request::post('start');
		$post['end']       = \dash\request::post('end');
		$post['colortext'] = \dash\request::post('colortext');
		$post['colordesc'] = \dash\request::post('colordesc');

		if(!$post['theme'])
		{
			\dash\notif::warn(T_("Please choose your theme"));
			return false;
		}

		$theme_detail = \lib\app\application\splash::set_android_theme($post);

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
