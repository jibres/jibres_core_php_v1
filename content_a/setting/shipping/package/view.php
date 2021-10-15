<?php
namespace content_a\setting\shipping\package;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Shipping package setting'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/shipping');

		\dash\data::shippingSettingSaved(\lib\app\setting\get::shipping_setting());

	}
}
?>