<?php
namespace content_a\setup\pos;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Point of sale hardwares'));
		$store_data = \lib\store::detail('store_data');
		\dash\data::dataRow($store_data);

	}
}
?>
