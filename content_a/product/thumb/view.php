<?php
namespace content_a\product\thumb;


class view
{
	public static function config()
	{
		$product_id          = \dash\request::get('id');
		\dash\data::product(\lib\app\product::get(['id' => $product_id]));

		\dash\data::page_title(T_('thumb product!'));


		if(isset($product['displayname']))
		{
			\dash\data::page_title(T_('thumb :name', ['name' => $product['displayname']]));
		}


		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());
	}
}
?>
