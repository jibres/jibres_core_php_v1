<?php
namespace content_a\setup\scale;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Set your store scale'));
		$store_data = \lib\store::detail('store_data');
		\dash\data::dataRow($store_data);

	}
}
?>
