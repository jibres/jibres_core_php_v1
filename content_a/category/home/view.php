<?php
namespace content_a\category\home;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Product Category'));

		\dash\face::btnView(\lib\store::url(). '/category');

		if(\dash\permission::check('manageProductTag'))
		{
			\dash\data::action_text(T_('Add new category'));
			\dash\data::action_icon('plus');
			\dash\data::action_link(\dash\url::this(). '/add');
		}

		\dash\data::back_text(T_('Product setting'));
		\dash\data::back_link(\dash\url::here(). '/setting/product');
		\dash\face::btnSetting(\dash\url::this().'/sort');


		$args =
		[
			'order'   => \dash\request::get('order'),
			'sort'    => \dash\request::get('sort'),
		];


		$search_string = \dash\validate::search_string();

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