<?php
namespace content_a\products\price;


class view
{
	public static function config()
	{

		\dash\data::page_title(T_('Product prices'));

		// btn
		\dash\data::action_text(T_('Add product'));
		\dash\data::action_link(\dash\url::this(). '/add');
		// operations
		\dash\data::page_import(\dash\url::this().'/import');
		\dash\data::page_export(\dash\url::this().'/export');

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


		if(\dash\request::get('duplicatetitle')) $args['duplicatetitle']   = true;
		if(\dash\request::get('hbarcode')) 		 $args['hbarcode'] 		 = true;
		if(\dash\request::get('hnotbarcode')) 	 $args['hnotbarcode'] 	 = true;
		if(\dash\request::get('wbuyprice')) 	 $args['wbuyprice'] 	 	 = true;
		if(\dash\request::get('wprice')) 		 $args['wprice'] 		 	 = true;
		if(\dash\request::get('wdiscount')) 	 $args['wdiscount'] 	 	 = true;

		$search_string = \dash\request::get('q');

		if($search_string && ctype_digit($search_string) && mb_strlen($search_string) === 13)
		{
			\dash\data::barcodeScaned('?barcode='. $search_string);
		}


		// set back link
		\lib\backlink::set_products();

		$myProductList = \lib\app\product\search::price_list($search_string, $args);

		\lib\app\product\load::barcode_is_scaned($myProductList, $search_string);

		\dash\data::dataTable($myProductList);

		\dash\data::filterBox(\lib\app\product\search::filter_message());
		\dash\data::sortList(\lib\app\product\filter::sort_list('price'));

		$isFiltered = \lib\app\product\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\data::page_title(\dash\data::page_title() . '  '. T_('Filtered'));
		}
	}
}
?>
