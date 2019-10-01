<?php
namespace content_a\products\general;


class controller
{
	public static function routing()
	{
		\dash\permission::access('ProductView');

		// check load product detail
		if(!\lib\app\products\load::one())
		{
			\dash\header::status(403);
		}
	}
}
?>
