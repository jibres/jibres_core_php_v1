<?php
namespace content_a\products\edit;


class view
{
	public static function config()
	{
		// set page title from product title
		$title = \dash\data::productDataRow_title();
		if(!isset($title))
		{
			$title = T_("Whitout name");
		}

		\dash\data::page_title($title);

		// back to list of product
		\dash\data::badge_text(T_('Back'));
		\dash\data::badge_link(\dash\url::this());

		$variants_list = \lib\app\product\variants::get(\dash\request::get('id'));
		\dash\data::variantsList($variants_list);

		$company_list = \lib\app\product\company::list();
		\dash\data::listCompanies($company_list);

		$unit_list = \lib\app\product\unit::list();
		\dash\data::listUnits($unit_list);

		$category_list = \lib\app\product\category::list();
		\dash\data::listCategory($category_list);

		// $tag_list = \lib\app\product\tag::list();
		// \dash\data::listCategory($tag_list);

	}
}
?>
