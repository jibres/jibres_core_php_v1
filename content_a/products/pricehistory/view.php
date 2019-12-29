<?php
namespace content_a\products\pricehistory;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Price change chart!'). ' | '. \dash\data::productDataRow_title());
		\dash\data::page_desc(T_('Check price change of this product like buy, sale and profit.'));
		\dash\data::page_pictogram('chart-line');

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());


		$chart = \lib\app\product\updateprice::chart(\dash\request::get('id'));
		\dash\data::cahrtDetail($chart);

	}
}
?>
