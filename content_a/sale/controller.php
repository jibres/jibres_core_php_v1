<?php
namespace content_a\sale;


class controller
{
	public static function routing()
	{
		\dash\permission::access('factorSaleAdd');
	}
}
?>
