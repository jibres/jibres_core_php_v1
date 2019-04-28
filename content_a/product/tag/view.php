<?php
namespace content_a\product\tag;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Product tag'). ' | '. \dash\data::dataRow_title());
		\dash\data::page_desc(T_('Manage warehouse setting of this product like count in each warehouse and some extra detail.'));
		\dash\data::page_pictogram('tag');

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());
	}
}
?>
