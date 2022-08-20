<?php
namespace lib\db\store_plan_history;


class get
{

	public static function last_plan_saved($_plan, $_store_id)
	{
		$query  = "SELECT * FROM store_plan_history WHERE  store_plan_history.store_id = $_store_id AND store_plan_history.plan = '$_plan' ORDER BY store_plan_history.id DESC LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true, 'master');
		return $result;
	}

    public static function activePlanList($_business_id, $_date)
    {

    }


}
?>
