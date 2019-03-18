<?php
namespace content_i\category\add;

class view
{
	public static function config()
	{
		$countryList = \dash\utility\location\countres::$data;
		\dash\data::countryList($countryList);

		\dash\data::page_title(T_("Add new category"));
		\dash\data::page_desc(T_("Add new category to set on transaction"));
		\dash\data::page_pictogram('tag');

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back'));

		\dash\data::parentList(\lib\app\category::parent_list());
		\dash\data::myList(\lib\app\category::list());
	}
}
?>