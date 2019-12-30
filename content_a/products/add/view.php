<?php
namespace content_a\products\add;


class view
{
	public static function config()
	{

		\dash\data::page_title(T_("Add new product"));

		// back to list of product
		\dash\data::badge_text(T_('Back'));
		\dash\data::badge_link(\dash\url::this());

		// back
		\dash\data::page_backText(T_('Products'));
		\dash\data::page_backLink(\dash\url::this());

		// \dash\data::page_help(\dash\url::support().'/product');

		$company_list = \lib\app\product\company::list();
		\dash\data::listCompanies($company_list);

		$unit_list = \lib\app\product\unit::list();
		\dash\data::listUnits($unit_list);

		$category_list = \lib\app\product\category::list();
		\dash\data::listCategory($category_list);


	}
}
?>
