<?php
namespace lib\db\sms_charge;


class get
{

	public static function store_total_charge($_store_id) : float
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


	public static function count_all()
	{
		return \dash\pdo\query_template::get_count('sms_charge', [], 'api_log');
	}


	public static function total_charge() : float
	{
		$query  = "SELECT SUM(sms_charge.amount) AS `budget` FROM sms_charge ";
		$param  = [];
		$result = \dash\pdo::get($query, $param, 'budget', true, 'api_log');
		return floatval($result);
	}


	public static function count_business()
	{
		$query  = "SELECT COUNT(DISTINCT sms_charge.store_id) AS `business` FROM sms_charge ";
		$param  = [];
		$result = \dash\pdo::get($query, $param, 'business', true, 'api_log');
		return floatval($result);
	}


	public static function avg_charge()
	{
		$query  = "SELECT AVG(sms_charge.amount) AS `avg` FROM sms_charge WHERE sms_charge.amount > 0 ";
		$param  = [];
		$result = \dash\pdo::get($query, $param, 'avg', true, 'api_log');
		return floatval($result);
	}


}
