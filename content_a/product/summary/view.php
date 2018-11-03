<?php
namespace content_a\product\summary;


class view
{
	public static function config()
	{
		\dash\permission::access('aProductReport');
		\dash\data::page_title(T_('Products Summary'));
		\dash\data::page_desc(T_('Some detail about your product!'));

		\dash\data::badge_text(T_('List of products'));
		\dash\data::badge_link( \dash\url::here().'/product');

		\dash\data::dashboardData(\lib\app\product\dashboard::detail());
	}
}
?>
