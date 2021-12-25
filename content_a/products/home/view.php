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

		$args = \lib\app\product\filter::get_args();

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



		if(!$myProductList)
		{
			// $ganje = \lib\app\product\ganje::search($search_string);
			// if($ganje)
			// {
			// 	\dash\data::listEngine_after(__DIR__ .'/ganje.php');
			// }
			// \dash\data::ganjeSearch($ganje);

		}

	}
}
?>
