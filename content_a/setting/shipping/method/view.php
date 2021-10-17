<?php
namespace content_a\setting\shipping\method;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Shipping method'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/shipping');

		\dash\data::methodList(\lib\app\setting\shipping_method::list());

	}
}
?>