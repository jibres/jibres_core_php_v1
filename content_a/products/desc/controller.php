<?php
namespace content_a\products\desc;


class controller
{
	public static function routing()
	{
		\dash\permission::access('ProductEdit');

		// check load product detail
		if(!\lib\app\product\load::one())
		{
			\dash\header::status(404);
		}

		// allow enter html
		\dash\open::html();

	}
}
?>
