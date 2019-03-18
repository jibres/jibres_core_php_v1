<?php
namespace content_i\jib\add;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Add new jib"));
		\dash\data::page_desc(T_("Add new jib"));
		\dash\data::page_pictogram('new-sign');

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back'));

		\dash\data::bankList(\lib\app\bank::list());

	}
}
?>