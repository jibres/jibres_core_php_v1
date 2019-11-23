<?php
namespace content_a\products\duplicate;


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

		$productDataRow = \dash\data::productDataRow();
		if(isset($productDataRow['parent']) && $productDataRow['parent'])
		{
			\dash\header::status(400, T_("This product is a child and can not duplicate it"));
		}
	}
}
?>
