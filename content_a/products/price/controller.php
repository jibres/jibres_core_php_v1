<?php
namespace content_a\products\price;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productListPrice');
	}
}
?>
