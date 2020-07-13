<?php
namespace content_a\setting\telegram\bot;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Telegram bot Setting'));


		// back
		\dash\data::back_text(T_('Telegram setting'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::productSettingSaved(\lib\app\setting\get::product_setting());

		\dash\data::defaultRatioSlider(T_("Default"));
	}
}
?>