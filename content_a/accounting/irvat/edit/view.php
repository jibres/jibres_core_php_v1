<?php
namespace content_a\accounting\irvat\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit factor"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '/all');

		\dash\data::titleList(\lib\app\irvat\get::title_list());

		\content_a\accounting\irvat\add\view::static_var();
	}
}
?>