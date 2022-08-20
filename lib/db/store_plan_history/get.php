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

    public static function activePlanList($_business_id, $_date_now) : array
    {
		$query =
			'
				SELECT * 
				FROM 
				    store_plan_history 
				WHERE 
				    store_plan_history.store_id = :store_id AND 
				    (
				        store_plan_history.expirydate IS NULL OR
				        store_plan_history.expirydate <= :date
				    )
				ORDER BY 
				    store_plan_history.expirydate DESC,
				    store_plan_history.id DESC
			';

		$param =
			[
				':store_id' => $_business_id,
				':date'     => $_date_now,
			];

		$result = \dash\pdo::get($query, $param);

		if(!is_array($result))
		{
			$result = [];
		}
		return $result;
    }


}
?>
