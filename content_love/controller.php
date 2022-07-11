<?php
namespace content_love;


class controller
{
	public static function routing()
	{
		\dash\redirect::to_login();

		if(\dash\engine\store::admin_subdomain())
		{
			\dash\redirect::admin_subdomain();
		}
		else
		{
			\dash\redirect::remove_subdomain();
		}


		\dash\redirect::remove_store();

		if(!\dash\permission::supervisor())
		{
			\dash\header::status(404);
		}
	}
}
?>
