<?php
namespace content_a\order\add;


class controller
{
	public static function routing()
	{
		\dash\permission::access('factorSaleAdd');
	}
}
?>
