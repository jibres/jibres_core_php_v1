<?php
namespace content_a\setting\order;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Order Setting'));

		// back
		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::orderSettingSaved(\lib\app\setting\get::order_setting());

	}
}
?>