<?php
namespace content_business\shipping;


class controller
{
	public static function routing()
	{
		if(!\lib\website::cart_count())
		{
			\dash\redirect::to(\dash\url::kingdom(). '/cart');
		}
	}
}
?>
