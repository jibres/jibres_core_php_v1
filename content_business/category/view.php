<?php
namespace content_business\category;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Category"));

		// \dash\data::search_link(\dash\url::kingdom().'/search');

		if(\dash\data::dataRow())
		{

			\dash\data::tagFilterList(\lib\app\product\filter::list('tag_filter'));

			\dash\face::title(\dash\data::dataRow_seotitle());
			\dash\face::desc(\dash\data::dataRow_seodesc());
			\dash\face::cover(\dash\data::dataRow_file());

			$args =
			[
				// 'order'          => \dash\request::get('order'),
				// 'sort'           => \dash\request::get('sort'),
				'exp'            => \dash\request::get('exp'),
				'maxd'           => \dash\request::get('maxd'),
				'st'             => \dash\request::get('st'),
				'd'              => \dash\request::get('d'),
				'cat_id'         => \dash\data::dataRow_id(),
				'tag_with_child' => 1,
				'limit'          => 50,
			];

			$myProductList = \lib\app\product\search::website_product_search(\dash\validate::search_string(), $args);

			\dash\data::productList($myProductList);

		}
		else
		{
			\dash\data::displayShowTagList(true);
		}

		// btn
		if(\dash\url::child())
		{
			\dash\data::back_link(\dash\url::this());
		}
		else
		{
			\dash\data::back_link(\dash\url::kingdom());
		}
	}
}
?>