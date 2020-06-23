<?php
namespace content_subdomain\tag;

class view
{
	public static function config()
	{
		\dash\face::title(\lib\store::title(). ' | '. \dash\data::dataRow_title());

		if(\dash\data::dataRow_id())
		{
			$args =
			[
				'tag_id'       => \dash\data::dataRow_id(),
			];

			$myProductList = \lib\app\product\search::variant_list(null, $args);
			\dash\data::myProductList($myProductList);
		}
	}
}
?>