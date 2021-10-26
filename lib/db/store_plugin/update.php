<?php
namespace lib\db\store_plugin;


class update
{

	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('store_plugin', $_args, $_id);
	}


}
?>
