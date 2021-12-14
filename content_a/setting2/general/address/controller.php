<?php
namespace content_a\setting2\general\address;


class controller extends \content_a\setting2\home\controller
{
	public static function routing()
	{
		parent::routing();

		\dash\permission::access('settingBusinessEdit');

		$store_data = \lib\store::detail('store_data');
		\dash\data::dataRow($store_data);
	}
}
?>