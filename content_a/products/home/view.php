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

		$productFilterList = \lib\app\product\filter::list();
		\dash\data::productFilterList($productFilterList);
		$args =
		[
			'order'        => \dash\request::get('order'),
			'sort'         => \dash\request::get('sort'),
			'barcode'      => \dash\request::get('barcode'),
			'status'      => \dash\request::get('status'),
			// 'price'        => \dash\request::get('price'),
			// 'buyprice'     => \dash\request::get('buyprice'),
			// 'cat'          => \dash\request::get('cat'),
			'cat_id'       => \dash\request::get('catid') ? \dash\request::get('catid') : null,
			'tag_id'       => \dash\request::get('tagid') ? \dash\request::get('tagid') : null,
			// 'discount'     => \dash\request::get('discount'),
			'unit_id'      => \dash\request::get('unitid') ? \dash\request::get('unitid') : null,
			'company_id'   => \dash\request::get('companyid') ? \dash\request::get('companyid') : null,
		];


		if(\dash\request::get('dup')) 	$args['dup']  = \dash\request::get('dup');
		if(\dash\request::get('bar')) 	$args['bar']  = \dash\request::get('bar');
		if(\dash\request::get('bup')) 	$args['bup']  = \dash\request::get('bup');
		if(\dash\request::get('p')) 	$args['p']    = \dash\request::get('p');
		if(\dash\request::get('d')) 	$args['d']    = \dash\request::get('d');
		if(\dash\request::get('st')) 	$args['st']   = \dash\request::get('st');
		if(\dash\request::get('nst')) 	$args['nst']  = \dash\request::get('nst');
		if(\dash\request::get('g')) 	$args['g']    = \dash\request::get('g');
		if(\dash\request::get('v')) 	$args['v']    = \dash\request::get('v');
		if(\dash\request::get('so')) 	$args['so']   = \dash\request::get('so');
		if(\dash\request::get('w')) 	$args['w']    = \dash\request::get('w');
		if(\dash\request::get('t')) 	$args['t']    = \dash\request::get('t');


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


		$company_list = \lib\app\product\company::list();
		\dash\data::listCompanies($company_list);

		$unit_list = \lib\app\product\unit::list();
		\dash\data::listUnits($unit_list);

		$category_list = \lib\app\category\get::all_category();
		$category_list = array_reverse($category_list);
		\dash\data::listCategory($category_list);

		$all_tag = \lib\app\product\tag::all_tag();
		\dash\data::allTagList($all_tag);



	}
}
?>
