<?php
namespace content_my;


class controller
{
	public static function routing()
	{
		\dash\redirect::to_login(true);

		\dash\redirect::remove_subdomain();

		\dash\redirect::remove_store();
	}
}
?>
