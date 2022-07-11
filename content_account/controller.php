<?php
namespace content_account;

class controller
{
	/**
	 * rout
	 */
	public static function routing()
	{
		if(\dash\engine\store::admin_subdomain())
		{
			\dash\redirect::admin_subdomain();
		}
		else
		{
			\dash\redirect::remove_subdomain();
		}

		\dash\redirect::remove_store();
		\dash\redirect::to_login();
		\content_account\load::me();
	}
}
?>