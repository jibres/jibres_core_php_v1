<?php
namespace content_a\setup\unit;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Store currency'));
		$store_data = \lib\store::detail('store_data');
		\dash\data::dataRow($store_data);
		\dash\data::unitList(\lib\app\setting\setup::unit_list());
	}
}
?>
