<?php
namespace content_a\setting\product\free;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Free product setting'));

		// back
		\dash\data::back_text(T_('Product setting'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::productSettingSaved(\lib\app\setting\get::product_setting());

	}
}
?>