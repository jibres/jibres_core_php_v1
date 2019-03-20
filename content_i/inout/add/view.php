<?php
namespace content_i\inout\add;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Add new inout"));
		\dash\data::page_desc(T_("Add new inout"));
		\dash\data::page_pictogram('new-sign');

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back'));

		\dash\data::catList(\lib\app\category::list());
		\dash\data::jibList(\lib\app\jib::my_list());
	}
}
?>