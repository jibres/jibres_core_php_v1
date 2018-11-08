<?php
namespace content_a\buy;


class controller
{
	public static function routing()
	{
		\dash\permission::access('factorBuyAdd');
	}
}
?>
