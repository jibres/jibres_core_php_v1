<?php
namespace content_a\setting\cart\limit;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Cart Setting'));

		// back
		\dash\data::back_text(T_('Cart Setting'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::cartSettingSaved(\lib\app\setting\get::cart_setting());

	}
}
?>