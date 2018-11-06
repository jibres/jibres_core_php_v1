<?php
namespace content_a\product\pricehistory;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Price change chart!'). ' | '. \dash\data::dataRow_title());

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());


		$chart = \lib\app\productprice::chart(\dash\request::get('id'));
		\dash\data::cahrtDetail($chart);

	}
}
?>
