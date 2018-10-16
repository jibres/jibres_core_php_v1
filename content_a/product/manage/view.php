<?php
namespace content_a\product\manage;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Manage Product'));
		\dash\data::page_desc(T_('You can delete product easily form this page, be careful!'));

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());
	}
}
?>
