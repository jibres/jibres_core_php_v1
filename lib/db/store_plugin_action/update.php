<?php
namespace lib\db\store_plugin_action;


class update
{

	public static function record($_args, $_id)
	{
		$_args['datemodified'] = date("Y-m-d H:i:s");

		return \dash\pdo\query_template::update('store_plugin_action', $_args, $_id);
	}


}
?>
