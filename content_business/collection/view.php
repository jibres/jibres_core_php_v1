<?php
namespace content_business\collection;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Category"));

		\dash\data::search_link(\dash\url::kingdom().'/search');
		if(!\dash\data::dataRow())
		{
			$myCategoryList = \lib\app\category\search::list(null, ['showonwebsite' => 1]);

			\dash\data::categoryDataTable($myCategoryList);
		}
		else
		{
			\dash\face::title(\dash\data::dataRow_seotitle());
			\dash\face::desc(\dash\data::dataRow_seodesc());
			\dash\face::cover(\dash\data::dataRow_file());

			$args =
			[
				'order'        => \dash\request::get('order'),
				'sort'         => \dash\request::get('sort'),
				'cat_id'       => \dash\data::dataRow_id(),
				'limit'        => 50,
			];

			$myProductList = \lib\app\product\search::website_product_search(null, $args);

			\dash\data::productList($myProductList);
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
