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


		\dash\face::btnSetting(\dash\url::here().'/setting/product');


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\product\filter::list());
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\product\filter::sort_list());

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

			// 'discount'     => \dash\request::get('discount'),
			'unit_id'      => \dash\request::get('unitid') ? \dash\request::get('unitid') : null,
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
		if(\dash\request::get('tq')) 	$args['tq']    = \dash\request::get('tq');
		if(\dash\request::get('pr')) 	$args['pr']    = \dash\request::get('pr');

		if(\dash\detect\device::detectPWA())
		{
			$args['limit'] = 30;
		}

		$search_string = \dash\validate::search_string();


		if($search_string && ctype_digit($search_string) && mb_strlen($search_string) === 13)
		{
			\dash\data::barcodeScaned('?barcode='. $search_string);
			\dash\data::action_link(\dash\url::this(). '/add?barcode='. $search_string);
		}

		\dash\data::productSettingSaved(\lib\app\setting\get::product_setting());

		// set back link
		\lib\app\back_btn\link::set_products();

		$myProductList = \lib\app\product\search::variant_list($search_string, $args);


		\lib\app\product\load::barcode_is_scaned($myProductList, $search_string);

		\dash\data::dataTable($myProductList);

		$isFiltered = \lib\app\product\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}


		$unit_list = \lib\app\product\unit::list();
		\dash\data::listUnits($unit_list);

	}
}
?>
