<?php
namespace content_a\sale2;


class controller
{
	public static function routing()
	{
		\dash\permission::access('factorSaleAdd');
	}
}
?>
