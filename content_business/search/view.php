<?php
namespace content_business\search;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Search"));
		\dash\data::sortList(\lib\app\product\filter::sort_list('website'));


		$args =
		[
			'order'       => \dash\request::get('order'),
			'sort'        => \dash\request::get('sort'),
			'cat_id'      => \dash\request::get('catid'),
			'tag_id'      => \dash\request::get('tagid'),
			'company_id'  => \dash\request::get('companyid'),
			'websitemode' => true,
			'limit'       => 30,
		];


		$search_string = \dash\validate::search(\dash\request::get('q'));

		$myProductList = \lib\app\product\search::website_product_search($search_string, $args);

		\dash\data::dataTable($myProductList);

		\dash\data::filterBox(\lib\app\product\search::filter_message());

		$isFiltered = \lib\app\product\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

		\dash\data::back_link(\dash\url::kingdom());

	}
}
?>
