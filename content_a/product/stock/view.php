<?php
namespace content_a\product\stock;


class view
{
	public static function config()
	{

		\dash\data::page_title(T_('Stock Product'). ' | '. \dash\data::dataRow_title());
		\dash\data::page_desc(T_('You can check stock of product'));

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());
	}
}
?>
