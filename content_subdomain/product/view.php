<?php
namespace content_subdomain\product;


class view
{
	public static function config()
	{

		\dash\data::include_adminPanel(true);
		\dash\data::include_highcharts(true);

		\dash\data::page_title(T_('General setting'). ' | ' . \dash\data::dataRow_title());
		\dash\data::page_desc(T_('Manage general setting of product like name, category, price and etc.') .' '. T_('You can change another setting by choose another type of setting.'));
		\dash\data::page_pictogram('tag-2');

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::kingdom(). '/products');


	}
}
?>
