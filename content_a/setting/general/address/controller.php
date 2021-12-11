<?php
namespace content_a\setting\general\address;


class controller extends \content_a\setting\home\controller
{
	public static function routing()
	{
		parent::routing();

		$store_data = \lib\store::detail('store_data');
		\dash\data::dataRow($store_data);
	}
}
?>