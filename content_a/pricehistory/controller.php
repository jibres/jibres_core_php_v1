<?php
namespace content_a\pricehistory;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productPriceHistoryView');

		if(self::myId())
		{
			// check load product detail
			if(!\lib\app\product\load::one(self::myId()))
			{
				\dash\header::status(404);
			}

		}
	}


	public static function myId()
	{
		if(\dash\request::get('id'))
		{
			return \dash\request::get('id');
		}

		if(\dash\request::get('oid'))
		{
			return \dash\request::get('oid');
		}

		return null;
	}
}
?>
