<?php
namespace content_a\products\pricehistory;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productPriceHistoryView');

		// check load product detail
		if(!\lib\app\product\load::one())
		{
			\dash\header::status(404);
		}
	}
}
?>
