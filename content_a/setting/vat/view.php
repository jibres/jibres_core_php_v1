<?php
namespace content_a\setting\vat;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Tax settings'));
		$store_data = \lib\store::detail('store_data');
		\dash\data::dataRow($store_data);

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>
