<?php
namespace content_a\app\android\logo;

class model
{
	public static function post()
	{
		if(\dash\request::post('usestorelogo'))
		{
			\lib\app\application\detail::set_android_logo_from_store_logo();
		}
		else
		{
			\lib\app\application\detail::set_android_logo();
		}

		if(\dash\engine\process::status())
		{
			if(\dash\request::get('setup') === 'wizard')
			{
				\dash\redirect::to(\dash\url::that().'/setting?setup=wizard');
			}
			else
			{
				\dash\redirect::pwd();
			}
		}
	}
}
?>
