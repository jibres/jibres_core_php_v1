<?php
namespace content_a\products\price;


class view
{
	public static function config()
	{

		\dash\data::page_title(T_('List of products'));
		\dash\data::page_desc(T_('You can search in list of products, add new product and edit existing.'));
		\dash\data::page_pictogram('box');

		\dash\data::badge_text(T_('Add new product'));
		\dash\data::badge_link(\dash\url::this(). '/add');

		$args =
		[
			'order'        => \dash\request::get('order'),
			'sort'         => \dash\request::get('sort'),
			'barcode'      => \dash\request::get('barcode'),
			'price'        => \dash\request::get('price'),
			'buyprice'     => \dash\request::get('buyprice'),
			'cat'          => \dash\request::get('cat'),
			'cat_id'       => \dash\request::get('catid'),
			'discount'     => \dash\request::get('discount'),
			'unit_id'      => \dash\request::get('unitid'),
			'company_id'   => \dash\request::get('companyid'),
			'guarantee_id' => \dash\request::get('guaranteeid'),
			'filter'       => [],
		];


		if(\dash\request::get('duplicatetitle')) $args['filter']['duplicatetitle']   = true;
		if(\dash\request::get('hbarcode')) 		 $args['filter']['hbarcode'] 		 = true;
		if(\dash\request::get('hnotbarcode')) 	 $args['filter']['hnotbarcode'] 	 = true;
		if(\dash\request::get('justcode')) 		 $args['filter']['justcode'] 		 = true;
		if(\dash\request::get('wcodbarcode')) 	 $args['filter']['wcodbarcode'] 	 = true;
		if(\dash\request::get('wbuyprice')) 	 $args['filter']['wbuyprice'] 	 	 = true;
		if(\dash\request::get('wprice')) 		 $args['filter']['wprice'] 		 	 = true;
		if(\dash\request::get('wminstock')) 	 $args['filter']['wminstock'] 	 	 = true;
		if(\dash\request::get('wmaxstock')) 	 $args['filter']['wmaxstock'] 	 	 = true;
		if(\dash\request::get('wdiscount')) 	 $args['filter']['wdiscount'] 	 	 = true;
		if(\dash\request::get('negativeprofit')) $args['filter']['negativeprofit']   = true;

		$search_string = \dash\request::get('q');

		if($search_string)
		{
			\dash\data::page_title(T_('Search'). ' '.  $search_string);
		}

		$myProductList = \lib\app\products\search::price_list($search_string, $args);

		\lib\app\products\load::barcode_is_scaned($myProductList, $search_string);

		\dash\data::dataTable($myProductList);

		\dash\data::filterBox(\lib\app\products\search::filter_message());


	}
}
?>
