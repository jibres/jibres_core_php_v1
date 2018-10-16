<?php
namespace content_a\product;


class load
{
	public static function product()
	{
		if(!\dash\request::get('id'))
		{
			\dash\header::status(404, T_("Product id not set"));
		}

		$id = \dash\request::get('id');

		$result = \lib\app\product::get($id);
		if(!$result)
		{
			\dash\header::status(403, T_("Invalid product id"));
		}

		\dash\data::dataRow($result);
	}
}
?>
