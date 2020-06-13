<?php
namespace content_a\order;


class controller
{
	public static function routing()
	{
		\dash\permission::access('factorSaleAdd');
	}
}
?>
