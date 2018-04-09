<?php
namespace content_a\product\summary;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Products Summary'));
		\dash\data::page_desc(T_('Some detail about your product!'));

		\dash\data::page_badge_link( \dash\url::here().'/product');
		\dash\data::page_badge_text(T_('List of products'));

		\dash\data::dashboardData(\lib\app\product::dashboard());
	}
}
?>
