<?php
namespace content_a\products\edit;


class controller
{
	public static function routing()
	{
		\dash\permission::access('ProductEdit');

		// check load product detail
		if(!\lib\app\product\load::code())
		{
			\dash\header::status(403);
		}
	}
}
?>
