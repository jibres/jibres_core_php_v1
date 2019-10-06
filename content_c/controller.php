<?php
namespace content_c;


class controller
{
	public static function routing()
	{
		// \dash\redirect::to_login();

		/**
		 * if we have domain in this content
		 * redirect to Whithout subdomain
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
