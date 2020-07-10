<?php
namespace content_a\setting\product\setting;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Product Setting'));


		// back
		\dash\data::back_text(T_('Product setting'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::productSettingSaved(\lib\app\setting\get::product_setting());

		\dash\data::defaultRatioSlider(T_("Default"));
	}
}
?>