<?php
namespace content_a\products\add;


class view
{
	public static function config()
	{

		\dash\face::title(T_("Add new product"));


		// back
		\dash\data::back_text(T_('Products'));
		\dash\data::back_link(\lib\backlink::products());

		// \dash\data::page_help(\dash\url::support().'/product');

		$company_list = \lib\app\product\company::list();
		\dash\data::listCompanies($company_list);

		$unit_list = \lib\app\product\unit::list();
		\dash\data::listUnits($unit_list);

		$category_list = \lib\app\category\search::list();
		\dash\data::listCategory($category_list);


	}
}
?>
