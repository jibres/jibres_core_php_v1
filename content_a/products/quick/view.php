<?php
namespace content_a\products\quick;


class view
{
	public static function config()
	{
		if(!\dash\request::is_iframe())
		{
			// back
			\dash\data::back_text(T_('Products'));
			\dash\data::back_link(\lib\app\back_btn\link::products());
		}


		if(\dash\data::addMode())
		{
			\dash\face::title(T_("Quick add product"));
			\dash\face::btnInsert('aProductData');
			\dash\face::btnInsertText(T_("Add"));
			\dash\face::btnInsertValue('master');
		}
		else
		{
			\dash\face::title(T_("Quick edit product"));
			\dash\face::btnInsert('aProductData');
			\dash\face::btnInsertText(T_("Edit"));
			\dash\face::btnInsertValue('master');
		}


		if(\dash\request::get('gid') || \dash\request::get('barcode'))
		{
			$load_ganje_detail = \lib\app\product\ganje::fetch_by_id_barcode(\dash\request::get('gid'), \dash\request::get('barcode'));
			if(\dash\data::addMode())
			{
				\dash\data::productDataRow($load_ganje_detail);
			}

		}

	}
}
?>