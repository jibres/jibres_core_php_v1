<?php
namespace lib\db\store_plan;


class get
{

	public static function last_plan_saved($_plan, $_store_id)
	{
		$query  = "SELECT * FROM store_plan WHERE  store_plan.store_id = $_store_id AND store_plan.plan = '$_plan' ORDER BY store_plan.id DESC LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}


}
?>
