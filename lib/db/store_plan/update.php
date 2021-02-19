<?php
namespace lib\db\store_plan;


class update
{

	public static function set_status($_id, $_status)
	{
		$query  = "UPDATE store_plan SET store_plan.status = '$_status' WHERE  store_plan.id = $_id  LIMIT 1";
		$result = \dash\db::query($query, 'master');
		return $result;
	}


	public static function set_field($_id, $_field, $_value)
	{
		$query  = "UPDATE store_plan SET store_plan.$_field = '$_value' WHERE store_plan.id = $_id  LIMIT 1";
		$result = \dash\db::query($query, 'master');
		return $result;
	}


	public static function record($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if($set && $_id && is_numeric($_id))
		{
			// make update query
			$query = "UPDATE store_plan SET $set WHERE store_plan.id = $_id LIMIT 1";
			return \dash\db::query($query, 'master');
		}
	}

}
?>
