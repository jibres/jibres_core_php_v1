<?php
namespace content_a\setting\order\minimum;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Minimum order amount'));

		// back
		\dash\data::back_text(T_('Order Setting'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::cartSettingSaved(\lib\app\setting\get::cart_setting());

	}
}
?>