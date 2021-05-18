<?php
namespace content_business\tag;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Tag"));

		// \dash\data::search_link(\dash\url::kingdom().'/search');

		if(\dash\data::dataRow())
		{
			\dash\face::title(\dash\data::dataRow_seotitle());
			\dash\face::desc(\dash\data::dataRow_seodesc());
			\dash\face::cover(\dash\data::dataRow_file());

			$args =
			[
				'order'          => \dash\request::get('order'),
				'sort'           => \dash\request::get('sort'),
				'tag_id'         => \dash\data::dataRow_id(),
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
