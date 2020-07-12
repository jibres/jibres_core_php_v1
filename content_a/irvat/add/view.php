<?php
namespace content_a\irvat\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Add new facotr"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/all');

		\dash\data::titleList(\lib\app\irvat\get::title_list());
	}
}
?>