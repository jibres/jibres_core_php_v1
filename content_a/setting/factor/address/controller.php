<?php
namespace content_a\setting\factor\address;


class controller
{
	public static function routing()
	{
		$store_data = \lib\store::detail('store_data');
		\dash\data::dataRow($store_data);
	}
}
?>
