<?php
namespace content_a\product\add;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Add new product or goods'));
		\dash\data::page_desc(T_('You can set main property of product and allow to assign some extra or edit it later.'));
		\dash\data::page_pictogram('plus');

		if(\dash\permission::check('productList'))
		{
			\dash\data::badge_text(T_('Back to product list'));
			\dash\data::badge_link(\dash\url::this());
		}

		\dash\data::listCats(\lib\app\product\cat::all_list());
		\dash\data::listCompanies(\lib\app\product::company_list(false));
		\dash\data::listUnits(\lib\app\product\unit::list());


		// get some value from get
		if(\dash\request::get('barcode'))
		{
			\dash\data::dataRow_barcode(\dash\request::get('barcode'));
		}
		if(\dash\request::get('barcode2'))
		{
			\dash\data::dataRow_barcode2(\dash\request::get('barcode2'));
		}
		if(\dash\request::get('price'))
		{
			\dash\data::dataRow_price(\dash\request::get('price'));
		}
		if(\dash\request::get('discount'))
		{
			\dash\data::dataRow_discount(\dash\request::get('discount'));
		}
		if(\dash\request::get('buyprice'))
		{
			\dash\data::dataRow_buyprice(\dash\request::get('buyprice'));
		}
		if(\dash\request::get('title'))
		{
			\dash\data::dataRow_title(\dash\request::get('title'));
		}
	}
}
?>
