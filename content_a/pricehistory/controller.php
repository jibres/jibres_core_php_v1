<?php
namespace content_a\pricehistory;


class controller
{
	public static function routing()
	{

		if(\dash\request::get('id'))
		{
			if(!\lib\app\product\load::one(\dash\request::get('id')))
			{
				\dash\header::status(404);
			}
		}
		else
		{
			\dash\redirect::to(\dash\url::this(). '/choose');
		}
	}
}
?>
