<?php
namespace content_a\discount\add;


class controller
{
	public static function routing()
	{
		\dash\permission::access('manageDiscountCode');
	}
}
?>