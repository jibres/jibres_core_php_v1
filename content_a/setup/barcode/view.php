<?php
namespace content_a\setup\barcode;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Set your store barcode'));
		$store_data = \lib\store::detail('store_data');
		\dash\data::dataRow($store_data);

	}
}
?>
