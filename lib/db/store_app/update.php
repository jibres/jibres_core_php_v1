<?php
namespace lib\db\store_app;


class update
{

	public static function set_status($_id, $_status)
	{
		$query  = "UPDATE store_app SET store_app.status = '$_status' WHERE  store_app.id = $_id  LIMIT 1";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;
	}


	public static function set_field($_id, $_field, $_value)
	{
		$query  = "UPDATE store_app SET store_app.$_field = '$_value' WHERE store_app.id = $_id  LIMIT 1";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;
	}


	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('store_app', $_args, $_id, 'master');
	}

}
?>
