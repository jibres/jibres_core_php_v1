<?php
namespace content_a\product\summary;


class view
{
	public static function config()
	{

		\dash\data::page_title(T_('Products Summary'));
		\dash\data::page_desc(T_('Some detail about your product!'));

		if(\dash\permission::check('productList'))
		{
			\dash\data::badge_text(T_('List of products'));
			\dash\data::badge_link( \dash\url::here().'/product');
		}

		$detail = \lib\app\product\dashboard::detail();
		\dash\data::dashboardData($detail);
	}
}
?>
