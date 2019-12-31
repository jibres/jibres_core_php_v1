<?php
namespace content_a\products\api;


class controller
{
	public static function routing()
	{
		// show dropdown of product list
		\lib\app\product\site_list::dropdown();

		\dash\notif::api('Hi :)');
	}
}
?>
