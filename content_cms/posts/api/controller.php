<?php
namespace content_cms\posts\api;


class controller
{
	public static function routing()
	{
		// show dropdown of product list
		\dash\app\posts\dropdown::dropdown();

		\dash\notif::api('Hi :)');
	}
}
?>
