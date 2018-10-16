<?php
namespace content_a\product\maker;


class view
{
	public static function config()
	{
		$product = \dash\request::get('id');

		if($product)
		{
			\dash\data::product(\lib\app\product::get($product));
		}

		\dash\data::page_title(T_('Delete Product'));
		\dash\data::page_desc(T_('You can delete product easily form this page, be careful!'));

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());
	}
}
?>
