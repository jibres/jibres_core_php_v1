<?php
namespace lib\db\store_plugin;


class get
{
	public static function by_id($_id)
	{
		return \dash\pdo\query_template::get('store_plugin', $_id);
	}

	public static function group_by_plugin()
	{
		$query = "SELECT COUNT(*) AS `count`, store_plugin.plugin FROM store_plugin GROUP BY store_plugin.plugin ";
		$param = [];
		$result = \dash\pdo::get($query, $param, ['plugin', 'count']);
		return $result;
	}


	public static function group_by_plugin_status($_status)
	{
		$query = "SELECT COUNT(*) AS `count`, store_plugin.plugin FROM store_plugin WHERE store_plugin.status = :status GROUP BY store_plugin.plugin ";
		$param = [':status' => $_status];
		$result = \dash\pdo::get($query, $param, ['plugin', 'count']);
		return $result;
	}


	public static function by_business_id_plugin_id_lock($_business_id, $_plugin_id, $_plugin)
	{
		$query = "SELECT * FROM store_plugin WHERE store_plugin.id = :plugin_id AND store_plugin.store_id = :store_id AND store_plugin.plugin = :plugin LIMIT 1 FOR UPDATE";

		$param =
		[
			':plugin_id' => $_plugin_id,
			':store_id'  => $_business_id,
			':plugin'    => $_plugin,
		];

		$result = \dash\pdo::get($query, $param, null, true);

		return $result;
	}

	public static function by_business_id_lock($_business_id, $_plugin)
	{
		$query = "SELECT * FROM store_plugin WHERE store_plugin.store_id = :id AND store_plugin.plugin = :plugin LIMIT 1 FOR UPDATE";

		$param =
		[
			':id'     => $_business_id,
			':plugin' => $_plugin,
		];

		$result = \dash\pdo::get($query, $param, null, true);

		return $result;
	}


	public static function active_by_business_id($_business_id)
	{
		$query = "SELECT * FROM store_plugin WHERE store_plugin.store_id = :id AND store_plugin.status = 'enable' ";
		$param = [':id' => $_business_id];

		$result = \dash\pdo::get($query, $param);

		return $result;
	}

	public static function all_business_id_activated_plugin()
	{
		$query = "SELECT DISTINCT store_plugin.store_id AS `id` FROM store_plugin ";
		$param = [];
		$result = \dash\pdo::get($query, $param, 'id');
		return $result;
	}



	public static function by_business_id($_business_id)
	{
		$query = "SELECT * FROM store_plugin WHERE store_plugin.store_id = :id ORDER BY store_plugin.id DESC";
		$param = [':id' => $_business_id];

		$result = \dash\pdo::get($query, $param);

		return $result;
	}



	public static function by_business_id_plugin($_business_id, $_plugin)
	{
		$query = "SELECT * FROM store_plugin WHERE store_plugin.store_id = :id AND store_plugin.plugin = :plugin LIMIT 1";
		$param = [':id' => $_business_id, ':plugin' => $_plugin];

		$result = \dash\pdo::get($query, $param, null, true);

		return $result;
	}



	public static function active_by_business_id_plugin($_business_id, $_plugin)
	{
		$query = "SELECT * FROM store_plugin WHERE store_plugin.store_id = :id AND store_plugin.plugin = :plugin AND store_plugin.status = 'enable' ORDER BY store_plugin.id ASC ";
		$param = [':id' => $_business_id, ':plugin' => $_plugin];

		$result = \dash\pdo::get($query, $param);

		return $result;
	}


	public static function active_plugin()
	{
		$query = "SELECT * FROM store_plugin WHERE store_plugin.status = 'enable' and store_plugin.expiredate > :now and store_plugin.plugin != 'sms_pack' ";
		$param = [':now' => date("Y-m-d H:i:s")];

		$result = \dash\pdo::get($query, $param);
		return $result;
	}


	public static function active_plugin_sms()
	{
		$query = "SELECT * FROM store_plugin WHERE store_plugin.status = 'enable'  and store_plugin.plugin = 'sms_pack' ";
		$param = [];

		$result = \dash\pdo::get($query, $param);
		return $result;
	}


}
?>
