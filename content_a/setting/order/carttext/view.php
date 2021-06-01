<?php
namespace content_a\setting\order\carttext;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Cart Setting'));

		// back
		\dash\data::back_text(T_('Order Setting'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::cartSettingSaved(\lib\app\setting\get::cart_setting());

	}
}
?>