<?php
namespace content_a\setting\inventory;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Inventory detail'). ' | '. \dash\data::store_name());
		\dash\data::page_desc(T_('Inventory detail'));

		$args = [];
		$args['pagenation'] = false;

		$inventory_list = \lib\app\inventory::list(null, $args);

		\dash\data::dataTable($inventory_list);

	}
}
?>