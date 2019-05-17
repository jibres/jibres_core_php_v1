<?php
namespace content_a\product\general;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('General setting'). ' | ' . \dash\data::dataRow_title());
		\dash\data::page_desc(T_('Manage general setting of product like name, category, price and etc.') .' '. T_('You can change another setting by choose another type of setting.'));
		\dash\data::page_pictogram('tag-2');

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());

		\dash\data::listCats(\lib\app\product\cat::all_list());
		\dash\data::listCompanies(\lib\app\product::company_list());
		\dash\data::listUnits(\lib\app\product\unit::list());
	}
}
?>
