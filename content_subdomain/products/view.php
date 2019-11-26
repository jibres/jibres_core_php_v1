<?php
namespace content_subdomain\products;


class view
{
	public static function config()
	{

		\dash\data::include_adminPanel(true);
		\dash\data::include_highcharts(true);

		\dash\data::page_title(T_('List of products'));

		$pageDesc = T_('You can search in list of products.');


		\dash\data::badge_text(T_('Back'));
		\dash\data::badge_link(\dash\url::kingdom());
		\dash\data::page_pictogram('box');

		$args =
		[
			'order'   => \dash\request::get('order'),
			'sort'    => \dash\request::get('sort'),
		];


		if(\dash\request::get('price'))
		{
			$args['price'] = \dash\request::get('price');
		}


		if(\dash\request::get('cat'))
		{
			$args['cat'] = \dash\request::get('cat');
		}

		if(\dash\request::get('discount'))
		{
			$args['discount'] = \dash\request::get('discount');
		}

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
		$myProductList = \lib\app\product::list($search_string, $args);
		\dash\data::dataTable($myProductList);


		\dash\data::myFilter(\content_a\filter::current(\lib\app\product::$sort_field, \dash\url::this()));


		\dash\data::filterBox(\content_a\filter::createMsg($args));
	}
}
?>
