<?php
namespace content_a\tag\home;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Product Tags'));


		if(\dash\permission::check('manageProductCategory'))
		{
			\dash\data::action_text(T_('Add new tag'));
			\dash\data::action_icon('plus');
			\dash\data::action_link(\dash\url::this(). '/add');
		}

		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::here(). '/setting/product');
		\dash\face::btnSetting(\dash\url::this().'/sort');


		$args =
		[
			'order'   => \dash\request::get('order'),
			'sort'    => \dash\request::get('sort'),
		];


		$search_string = \dash\request::get('q');

		// work with category list
		$myCategoryList = \lib\app\tag\search::list($search_string, $args);

		\dash\data::dataTable($myCategoryList);

		\dash\data::filterBox(\lib\app\tag\search::filter_message());

		$isFiltered = \lib\app\tag\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . ' | '. T_('Filtered'));
		}

	}
}
?>