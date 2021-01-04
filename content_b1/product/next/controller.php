<?php
namespace content_b1\product\next;


class controller
{
	public static function routing()
	{


		\dash\permission::access('ProductEdit');
	}
}
?>