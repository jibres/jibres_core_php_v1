<?php
namespace content_a\category\home;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Product categories'));
		\dash\face::desc(T_('You can manage your categories manually.'). ' '. T_("Don't worry! we are add categories automatically on add new product"));


		if(\dash\permission::check('categoryAdd'))
		{
			\dash\data::action_text(T_('Add new category'));
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

		if($search_string)
		{
			\dash\face::title(T_('Search'). ' '.  $search_string);
		}

		// work with product list
		$myCategoryList = \lib\app\category\search::list($search_string, $args);

		\dash\data::dataTable($myCategoryList);

		\dash\data::dataFilter(\content_a\filter::createMsg($args));

		\dash\data::filterBox(\content_a\filter::createMsg($args));
	}
}
?>