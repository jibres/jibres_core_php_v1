<?php
namespace lib\db\store_plan;


class update
{

	public static function set_status($_id, $_status)
	{
		$query  = "UPDATE store_plan SET store_plan.status = '$_status' WHERE  store_plan.id = $_id  LIMIT 1";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;
	}


	public static function set_field($_id, $_field, $_value)
	{
		$query  = "UPDATE store_plan SET store_plan.$_field = '$_value' WHERE store_plan.id = $_id  LIMIT 1";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;
	}


	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('store_plan', $_args, $_id, 'master');

	}

}
?>
