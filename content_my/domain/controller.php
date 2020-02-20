<?php
namespace content_my\domain;


class controller
{
	public static function routing()
	{

		\dash\redirect::remove_subdomain();

	}


	public static function check_login()
	{
		\dash\redirect::to_login();
	}
}
?>
