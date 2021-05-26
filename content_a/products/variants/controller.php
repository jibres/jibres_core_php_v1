<?php
namespace content_a\products\variants;


class controller
{
	public static function routing()
	{
		\dash\permission::access('ProductEdit');


		\dash\data::productSettingSaved(\lib\app\setting\get::product_setting());

		// check load product detail
		if(!\lib\app\product\load::one())
		{
			\dash\header::status(404);
		}
	}
}
?>
