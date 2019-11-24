<?php
namespace content_a\setup\logo;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Set logo of your store'));
		$store_data = \lib\store::detail('store_data');
		\dash\data::dataRow($store_data);

	}
}
?>
