<?php
namespace content_a\product\cats;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Product categories'). ' | '. \dash\data::store_name());
		\dash\data::page_desc(T_('You can manage your categories manually.'). ' '. T_("Don't worry! we are add categories automatically on add new product"));
		\dash\data::page_pictogram('grid-1');

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());
	}
}
?>