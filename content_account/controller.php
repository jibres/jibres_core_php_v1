<?php
namespace content_account;

class controller
{
	/**
	 * rout
	 */
	public static function routing()
	{
		\dash\redirect::remove_subdomain();
		\dash\redirect::remove_store();
		\dash\redirect::to_login();
		\content_account\load::me();
	}
}
?>