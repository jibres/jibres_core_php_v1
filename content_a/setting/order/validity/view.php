<?php
namespace content_a\setting\order\validity;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Order Validity'));

		// back
		\dash\data::back_text(T_('Order Setting'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::orderSettingSaved(\lib\app\setting\get::order_setting());

	}
}
?>