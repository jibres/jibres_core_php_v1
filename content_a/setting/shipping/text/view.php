<?php
namespace content_a\setting\shipping\text;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Shipping Text'));

		// back
		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::shippingSettingSaved(\lib\app\setting\get::shipping_setting());

	}
}
?>