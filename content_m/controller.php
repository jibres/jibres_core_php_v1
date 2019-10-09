<?php
namespace content_m;


class controller
{
	public static function routing()
	{
		// \dash\redirect::to_login();

		/**
		 * if we have domain in this content
		 * redirect to Whithout subdomain
		 */

		\dash\redirect::remove_subdomain();
	}
}
?>
