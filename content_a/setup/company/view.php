<?php
namespace content_a\setup\company;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Store legal information'));
		$store_data = \lib\store::detail('store_data');
		\dash\data::dataRow($store_data);
	}
}
?>
