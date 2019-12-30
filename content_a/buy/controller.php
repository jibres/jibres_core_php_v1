<?php
namespace content_a\buy;


class controller
{
	public static function routing()
	{
		// show dropdown of product list
		\lib\app\product\site_list::dropdown();

		\dash\permission::access('factorBuyAdd');
	}
}
?>
