<?php
namespace content_love\store\api;


class controller
{
	public static function routing()
	{
		// show dropdown of product list
		\lib\app\store\dropdown::dropdown();

		\dash\notif::api('Hi :)');
	}
}
?>
