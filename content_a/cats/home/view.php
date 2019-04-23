<?php
namespace content_a\cats\home;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Product categories'));
		\dash\data::page_desc(T_('You can manage your categories manually.'). ' '. T_("Don't worry! we are add categories automatically on add new product"));
		\dash\data::page_pictogram('grid-1');

		if(\dash\permission::check('categoryAdd'))
		{
			\dash\data::badge_text(T_('Add new category'));
			\dash\data::badge_link(\dash\url::this(). '/add');
		}


		$args =
		[
			'order'   => \dash\request::get('order'),
			'sort'    => \dash\request::get('sort'),
		];



		if(\dash\request::get('unit'))
		{
			$args['unit'] = \dash\request::get('unit');
		}


		$search_string = \dash\request::get('q');

		if($search_string)
		{
			\dash\data::page_title(T_('Search'). ' '.  $search_string);
		}

		// work with product list
		$myProductList = \lib\app\product\cat::list($search_string, $args);
		\dash\data::dataTable($myProductList);

		\dash\data::myFilter(\content_a\filter::current(\lib\app\product\cat::$sort_field, \dash\url::this()));

		\dash\data::filterBox(\content_a\filter::createMsg($args));
	}
}
?>