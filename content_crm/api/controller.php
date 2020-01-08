<?php
namespace content_crm\api;


class controller
{
	public static function routing()
	{
		// show dropdown of product list
		\dash\app\user\site_list::dropdown();

		\dash\notif::api('Hi :)');
	}
}
?>
