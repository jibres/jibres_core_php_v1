<?php
namespace content_a\setup\vat;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Tax settings'));
		$store_data = \lib\store::detail('store_data');
		\dash\data::dataRow($store_data);

	}
}
?>
