<?php
namespace content_a\setup\currency;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Store currency'));
		$store_data = \lib\store::detail('store_data');
		\dash\data::dataRow($store_data);
		\dash\data::currencyList(\lib\currency::list());
	}
}
?>
