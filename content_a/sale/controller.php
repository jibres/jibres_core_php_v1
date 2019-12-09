<?php
namespace content_a\sale;


class controller
{
	public static function routing()
	{
		// show dropdown of product list
		\lib\app\product\site_list::dropdown();

		\dash\permission::access('factorSaleAdd');
	}
}
?>
