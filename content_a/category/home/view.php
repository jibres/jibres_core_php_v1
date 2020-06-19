<?php
namespace content_a\category\home;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Product categories'));


		if(\dash\permission::check('categoryAdd'))
		{
			\dash\data::action_text(T_('Add new category'));
			\dash\data::action_icon('plus');
			\dash\data::action_link(\dash\url::this(). '/add');
		}

		\dash\data::back_text(T_('Products'));
		\dash\data::back_link(\dash\url::here(). '/products');


		$args =
		[
			'order'   => \dash\request::get('order'),
			'sort'    => \dash\request::get('sort'),
		];


		$search_string = \dash\request::get('q');

		// work with category list
		$myCategoryList = \lib\app\category\search::list($search_string, $args);

		\dash\data::dataTable($myCategoryList);

		\dash\data::filterBox(\lib\app\category\search::filter_message());

		$isFiltered = \lib\app\category\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . ' | '. T_('Filtered'));
		}

	}
}
?>