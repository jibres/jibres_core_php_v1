<?php
namespace content_a\products\home;


class view
{
	public static function config()
	{

		\dash\data::page_title(T_('Products'));
		\dash\data::page_desc(T_('You can search in list of products, add new product and edit existing.'));

		// enable titleBox
		\dash\data::page_titleBox(true);

		if(\dash\request::get('inside'))
		{
			// nav
			\dash\data::page_next('disabled');
			\dash\data::page_prev(\dash\url::this(). '/prev');
			// back
			\dash\data::page_backText(T_('Dashboard'));
			\dash\data::page_backLink(\dash\url::here());
			\dash\data::page_duplicate(\dash\url::here());
			\dash\data::page_view(\dash\url::here());
			\dash\data::page_help(\dash\url::kingdom().'/support/test');
		}
		else
		{
			// btn
			\dash\data::page_btnText(T_('Add product'));
			\dash\data::page_btnLink(\dash\url::this(). '/add');
			// operations
			\dash\data::page_import(\dash\url::here());
			\dash\data::page_export(\dash\url::here());
		}

		$args =
		[
			'order'        => \dash\request::get('order'),
			'sort'         => \dash\request::get('sort'),
			'barcode'      => \dash\request::get('barcode'),
			// 'price'        => \dash\request::get('price'),
			// 'buyprice'     => \dash\request::get('buyprice'),
			// 'cat'          => \dash\request::get('cat'),
			// 'cat_id'       => \dash\request::get('catid'),
			// 'discount'     => \dash\request::get('discount'),
			// 'unit_id'      => \dash\request::get('unitid'),
			// 'company_id'   => \dash\request::get('companyid'),
			'filter'       => [],
		];

		if(\dash\request::get('duplicatetitle')) $args['filter']['duplicatetitle']   = true;
		if(\dash\request::get('hbarcode')) 		 $args['filter']['hbarcode'] 		 = true;
		if(\dash\request::get('hnotbarcode')) 	 $args['filter']['hnotbarcode'] 	 = true;
		if(\dash\request::get('wbuyprice')) 	 $args['filter']['wbuyprice'] 	 	 = true;
		if(\dash\request::get('wprice')) 		 $args['filter']['wprice'] 		 	 = true;
		if(\dash\request::get('wdiscount')) 	 $args['filter']['wdiscount'] 	 	 = true;

		$search_string = \dash\request::get('q');


		$myProductList = \lib\app\product\search::variant_list($search_string, $args);

		\lib\app\product\load::barcode_is_scaned($myProductList, $search_string);

		\dash\data::dataTable($myProductList);

		\dash\data::filterBox(\lib\app\product\search::filter_message());
		\dash\data::sortList(\lib\app\product\filter::sort_list());

		$isFiltered = \lib\app\product\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\data::page_title(\dash\data::page_title() . '  '. T_('Filtered'));
		}
	}
}
?>
