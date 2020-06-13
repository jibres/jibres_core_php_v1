<?php
namespace content_b1\product\search;


class view
{
	public static function config()
	{
		$args =
		[
			// 'cat_id'     => $category_id,
			// 'company_id' => $_company_id,
			'order'      => \dash\request::get('order'),
			'sort'       => \dash\request::get('sort'),
			'filter'     => [],
		];

		$category = \dash\request::get('category');
		if($category)
		{
			$args['cat_id'] = $category;
		}

		$company  = \dash\request::get('company');

		if($company)
		{
			$args['company'] = $company;
		}

		$collection  = \dash\request::get('collection');


		$search_query = \dash\request::get('q');

		$myProductList  = \lib\app\product\search::variant_list($search_query, $args);
		$filter_message = \lib\app\product\search::filter_message();
		$isFiltered     = \lib\app\product\search::is_filtered();

		\content_b1\tools::say($myProductList);
	}
}
?>