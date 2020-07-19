<?php
namespace content_a\products\home;


class view
{
	public static function config()
	{

		\dash\face::title(T_('Products'));

		// back
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		// btn
		\dash\data::action_text(T_('Add product'));
		\dash\data::action_icon('plus');
		\dash\data::action_link(\dash\url::this(). '/add');
		// operations
		\dash\face::btnImport(\dash\url::this().'/import');
		\dash\face::btnExport(\dash\url::this().'/export');
		// \dash\face::help(\dash\url::support().'/products');
		\dash\face::btnSetting(\dash\url::here().'/setting/product');

		$args =
		[
			'order'        => \dash\request::get('order'),
			'sort'         => \dash\request::get('sort'),
			'barcode'      => \dash\request::get('barcode'),
			// 'price'        => \dash\request::get('price'),
			// 'buyprice'     => \dash\request::get('buyprice'),
			// 'cat'          => \dash\request::get('cat'),
			'cat_id'       => \dash\request::get('catid'),
			'tag_id'       => \dash\request::get('tagid'),
			// 'discount'     => \dash\request::get('discount'),
			'unit_id'      => \dash\request::get('unitid'),
			'company_id'   => \dash\request::get('companyid'),
		];

		if(\dash\request::get('duplicatetitle')) $args['duplicatetitle'] = true;
		if(\dash\request::get('hbarcode')) 		 $args['hbarcode']       = true;
		if(\dash\request::get('hnotbarcode')) 	 $args['hnotbarcode']    = true;
		if(\dash\request::get('wbuyprice')) 	 $args['wbuyprice']      = true;
		if(\dash\request::get('wprice')) 		 $args['wprice']         = true;
		if(\dash\request::get('wdiscount')) 	 $args['wdiscount']      = true;
		if(\dash\request::get('instock')) 		 $args['instock']        = true;
		if(\dash\request::get('outofstock')) 	 $args['outofstock']     = true;
		if(\dash\request::get('withoutimage'))   $args['withoutimage']   = true;
		if(\dash\request::get('havevariants')) 	 $args['havevariants']   = true;

		$search_string = \dash\validate::search(\dash\request::get('q'));


		if($search_string && ctype_digit($search_string) && mb_strlen($search_string) === 13)
		{
			\dash\data::barcodeScaned('?barcode='. $search_string);
		}

		\dash\data::productSettingSaved(\lib\app\setting\get::product_setting());

		// set back link
		\lib\backlink::set_products();

		if(\dash\get::index(\dash\data::productSettingSaved(), 'default_pirce_list'))
		{
			$myProductList = \lib\app\product\search::price_list($search_string, $args);
		}
		else
		{
			$myProductList = \lib\app\product\search::variant_list($search_string, $args);
		}

		\lib\app\product\load::barcode_is_scaned($myProductList, $search_string);

		\dash\data::dataTable($myProductList);

		\dash\data::filterBox(\lib\app\product\search::filter_message());

		\dash\data::sortList(\lib\app\product\filter::sort_list());

		$isFiltered = \lib\app\product\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}



	}
}
?>
