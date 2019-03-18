<?php
namespace content_i\category\add;

class view
{
	public static function config()
	{
		$countryList = \dash\utility\location\countres::$data;
		\dash\data::countryList($countryList);

		\dash\data::page_title(T_("Add new category account detail"));
		\dash\data::page_desc(T_("Add new account detail"));
		\dash\data::page_pictogram('new-sign');

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back'));


	}
}
?>