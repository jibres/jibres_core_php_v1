<?php
namespace content_a\products\pricehistory;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Price change chart!'). ' | '. \dash\data::productDataRow_title());
		\dash\data::page_desc(T_('Check price change of this product like buy, sale and profit.'));
		\dash\data::page_pictogram('chart-line');

		// back
		\dash\data::page_backText(T_('Back'));
		\dash\data::page_backLink(\dash\url::this(). '/edit?id='. \dash\request::get('id'));



		$chart = \lib\app\product\updateprice::chart(\dash\request::get('id'));
		\dash\data::cahrtDetail($chart);

	}
}
?>
