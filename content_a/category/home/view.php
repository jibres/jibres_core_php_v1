<?php
namespace content_a\category\home;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Product categories'));
		\dash\data::page_desc(T_('You can manage your categories manually.'). ' '. T_("Don't worry! we are add categories automatically on add new product"));


		if(\dash\permission::check('categoryAdd'))
		{
			\dash\data::action_text(T_('Add new category'));
			\dash\data::action_link(\dash\url::this(). '/add');
		}


		$args =
		[
			'order'   => \dash\request::get('order'),
			'sort'    => \dash\request::get('sort'),
		];


		$search_string = \dash\request::get('q');

		if($search_string)
		{
			\dash\data::page_title(T_('Search'). ' '.  $search_string);
		}

		// work with product list
		$myCategoryList = \lib\app\category\search::list($search_string, $args);

		\dash\data::dataTable($myCategoryList);

		\dash\data::myFilter(\content_a\filter::current(['title', 'count', 'slug'], \dash\url::this()));

		\dash\data::filterBox(\content_a\filter::createMsg($args));
	}
}
?>