<?php
namespace content_a\setting\product\preparationtime;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Set preparation time'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '/setting');

		\dash\data::productSettingSaved(\lib\app\setting\get::product_setting());

	}
}
?>