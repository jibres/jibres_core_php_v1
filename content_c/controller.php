<?php
namespace content_c;


class controller
{
	public static function routing()
	{
		\dash\redirect::to_login();

		\dash\redirect::remove_subdomain();
	}
}
?>
