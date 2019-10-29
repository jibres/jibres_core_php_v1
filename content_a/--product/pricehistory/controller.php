<?php
namespace content_a\product\pricehistory;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productPriceHistoryView');
		\content_a\product\load::product();
	}
}
?>
