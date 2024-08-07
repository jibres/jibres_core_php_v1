<?php
namespace content_a\android\logo;

class model
{
	public static function post()
	{
		if(\dash\request::post('removelogo'))
		{
			\lib\app\application\detail::remove_logo();
		}
		elseif(\dash\request::post('usestorelogo'))
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
				\dash\redirect::to(\dash\url::this().'/title?setup=wizard');
			}
			else
			{
				\dash\redirect::pwd();
			}
		}
	}
}
?>
