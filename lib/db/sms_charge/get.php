<?php
namespace lib\db\sms_charge;


class get
{

	public static function total_charge($_store_id) : float
	{
		$query  = "SELECT SUM(sms_charge.amount) AS `budget` FROM sms_charge WHERE  sms_charge.store_id = :store_id ";
		$param  = [':store_id' => $_store_id];
		$result = \dash\pdo::get($query, $param, 'budget', true, 'api_log');
		return floatval($result);
	}


	public static function by_id($_id)
	{
		$query  = "SELECT * FROM sms_charge WHERE  sms_charge.id = $_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true, 'api_log');
		return $result;
	}


}
