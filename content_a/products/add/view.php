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

		\dash\face::btnInsert('aProductData');
		\dash\face::btnInsertValue('master');
		\dash\face::btnInsertText(T_("Add"));
		//
		// \dash\face::help(\dash\url::support().'/product');

		$company_list = \lib\app\product\company::list();
		\dash\data::listCompanies($company_list);

		$unit_list = \lib\app\product\unit::list();
		\dash\data::listUnits($unit_list);

		$category_list = \lib\app\category\search::list(null, ['pagination' => false]);
		\dash\data::listCategory($category_list);


		$productSettingSaved = \lib\app\setting\get::product_setting();
		\dash\data::productSettingSaved($productSettingSaved);

		$productImageRatioHtml = 'data-ratio=1 data-ratio-free';
		if(isset($productSettingSaved['ratio_detail']['ratio']))
		{
			$productImageRatioHtml = 'data-ratio='. $productSettingSaved['ratio_detail']['ratio'];
		}
		\dash\data::productImageRatioHtml($productImageRatioHtml);


	}
}
?>