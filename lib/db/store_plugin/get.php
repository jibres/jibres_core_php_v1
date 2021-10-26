<?php
namespace lib\db\store_plugin;


class get
{

	public static function group_by_plugin_key()
	{
		$query = "SELECT COUNT(*) AS `count`, store_plugin.plugin_key FROM store_plugin GROUP BY store_plugin.plugin_key ";
		$param = [];
		$result = \dash\pdo::get($query, $param, ['plugin_key', 'count']);
		return $result;
	}


	public static function group_by_plugin_key_status($_status)
	{
		$query = "SELECT COUNT(*) AS `count`, store_plugin.plugin_key FROM store_plugin WHERE store_plugin.status = :status GROUP BY store_plugin.plugin_key ";
		$param = [':status' => $_status];
		$result = \dash\pdo::get($query, $param, ['plugin_key', 'count']);
		return $result;
	}


	public static function by_business_id_lock($_business_id)
	{
		$query = "SELECT * FROM store_plugin WHERE store_plugin.store_id = :id FOR UPDATE";
		$param = [':id' => $_business_id];

		$result = \dash\pdo::get($query, $param);

		return $result;
	}


	public static function active_by_business_id($_business_id)
	{
		$query = "SELECT * FROM store_plugin WHERE store_plugin.store_id = :id AND store_plugin.status = 'enable' ";
		$param = [':id' => $_business_id];

		$result = \dash\pdo::get($query, $param);

		return $result;
	}


	public static function by_business_id($_business_id)
	{
		$query = "SELECT * FROM store_plugin WHERE store_plugin.store_id = :id ";
		$param = [':id' => $_business_id];

		$result = \dash\pdo::get($query, $param);

		return $result;
	}



	public static function by_business_id_plugin($_business_id, $_plugin)
	{
		$query = "SELECT * FROM store_plugin WHERE store_plugin.store_id = :id AND store_plugin.plugin_key = :plugin_key LIMIT 1";
		$param = [':id' => $_business_id, ':plugin_key' => $_plugin];

		$result = \dash\pdo::get($query, $param, null, true);

		return $result;
	}


}
?>
