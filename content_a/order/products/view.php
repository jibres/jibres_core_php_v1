<?php
namespace content_a\order\products;


class view
{
	public static function config()
	{

		// show dropdown of product list
		\lib\app\product\site_list::dropdown();

		\content_a\order\view::master_order_view();
	}
}
?>
