<?php
namespace content_crm\api;


class view
{
	public static function config()
	{
		// show dropdown of product list
		\dash\app\user\site_list::dropdown();

		\dash\notif::api('Hi :)');
	}
}
?>
