<?php
namespace content_a\setting\product\viewtext;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Product View Text'));

		// back
		\dash\data::back_text(T_('Product setting'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::productSettingSaved(\lib\app\setting\get::product_setting());

	}
}
?>