<?php
namespace content_a\discount\duplicate;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Duplidate from discount code"));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));

		\dash\data::discountSummary(\lib\app\discount\get::summary(\dash\request::get('id'), \dash\data::dataRow()));
	}
}
?>