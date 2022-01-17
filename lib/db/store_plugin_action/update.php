<?php
namespace lib\db\store_plugin_action;


class update
{

	public static function record($_args, $_id)
	{
		$_args['datemodified'] = date("Y-m-d H:i:s");

		return \dash\pdo\query_template::update('store_plugin_action', $_args, $_id);
	}

	public static function set_status_by_plugin_id($_status, $_plugin_id)
	{
		$param = [':plugin_id' => $_plugin_id, ':status' => $_status];

		$query  = "UPDATE store_plugin_action SET store_plugin_action.status = :status WHERE  store_plugin_action.plugin_id = :plugin_id ";
		$result = \dash\pdo::query($query, $param);
		return $result;
	}



}
?>
