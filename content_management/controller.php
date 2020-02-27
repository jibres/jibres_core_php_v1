<?php
namespace content_management;


class controller
{
	public static function routing()
	{
		\dash\redirect::to_login();

		\dash\redirect::remove_subdomain();

		\dash\permission::access('listOfStores');
	}
}
?>
