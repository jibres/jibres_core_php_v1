<?php
namespace content_c;


class controller
{
	public static function routing()
	{
		if(!\dash\user::login())
		{
			\dash\redirect::to(\dash\url::kingdom(). '/enter');
			return;
		}

		/**
		 * if we have domain in this content
		 * redirect to whitout subdomain
		 */
		if(\dash\url::subdomain())
		{
			$url = \dash\url::site() . '/c';
			\dash\redirect::to($url);
			return;
		}
	}
}
?>
