<?php
namespace content_love;


class controller
{
	public static function routing()
	{
		\dash\redirect::to_login();

		\dash\redirect::remove_subdomain();

		\dash\redirect::remove_store();

		\dash\permission::access('listOfStores');
	}
}
?>
