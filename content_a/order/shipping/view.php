<?php
namespace content_a\order\shipping;


class view
{
	public static function config()
	{
		\content_a\order\view::master_order_view();

		\dash\data::packageList(\lib\app\setting\package::list());
		\dash\data::methodList(\lib\app\setting\shipping_method::list());

	}
}
?>
