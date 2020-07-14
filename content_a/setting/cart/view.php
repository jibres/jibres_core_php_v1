<?php
namespace content_a\setting\cart;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Cart Setting'));

		// back
		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::cartSettingSaved(\lib\app\setting\get::cart_setting());

	}
}
?>