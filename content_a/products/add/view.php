<?php
namespace content_a\products\add;


class view
{
	public static function config()
	{

		\dash\face::title(T_("Add new product"));

		if(!\dash\request::is_iframe())
		{
			// back
			\dash\data::back_text(T_('Products'));
			\dash\data::back_link(\lib\app\back_btn\link::products());
		}

		\dash\face::btnInsert('aProductData');
		\dash\face::btnInsertText(T_("Add"));
		\dash\face::btnInsertValue('master');

		// $unit_list = \lib\app\product\unit::list();
		// \dash\data::listUnits($unit_list);

		\content_a\products\edit\view::product_ratio();

		if(\dash\request::get('gid') || \dash\request::get('barcode'))
		{
			$load_ganje_detail = \lib\app\product\ganje::fetch_by_id_barcode(\dash\request::get('gid'), \dash\request::get('barcode'));
			\dash\data::productDataRow($load_ganje_detail);
			if(a($load_ganje_detail, 'category') && is_array($load_ganje_detail['category']))
			{
				\dash\data::listSavedCat(array_column($load_ganje_detail['category'], 'title'));
			}
		}

	}
}
?>