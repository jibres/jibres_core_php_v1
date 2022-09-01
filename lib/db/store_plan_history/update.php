<?php
namespace lib\db\store_plan_history;


class update
{

	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('store_plan_history', $_args, $_id, 'master');

	}


	public static function allOldActivePlanOnDeactive($_business_id)
	{
		$query =
			"
				UPDATE store_plan_history 
				SET store_plan_history.status = 'deactive' 
				WHERE 
				    store_plan_history.store_id = :store_id AND 
				    store_plan_history.status = 'active'
			";
		$param = [':store_id' => $_business_id];
		return \dash\pdo::query($query, $param);
	}

}
?>
