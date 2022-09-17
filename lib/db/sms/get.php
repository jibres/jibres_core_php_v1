<?php
namespace lib\db\sms;


class get
{


	public static function by_id($_id)
	{
		$query  = "SELECT * FROM sms WHERE  sms.id = $_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true, 'api_log');
		return $result;
	}


	public static function store_spent($_store_id)
	{
		$query  =
			"SELECT SUM(sms.final_cost) AS `spent` FROM sms WHERE  sms.store_id = :store_id AND sms.calculate_cost = 1 ";
		$param  = [':store_id' => $_store_id];
		$result = \dash\pdo::get($query, $param, 'spent', true, 'api_log');
		return floatval($result);
	}


	public static function by_messageid($_messageid)
	{
		$query  = "SELECT * FROM sms WHERE  sms.provider_messageid = :messageid LIMIT 1";
		$param  =
			[
				':messageid' => $_messageid,
			];
		$result = \dash\pdo::get($query, $param, null, true, 'api_log');
		return $result;
	}


	public static function by_multi_id(string $_ids)
	{
		$query  = "SELECT * FROM sms WHERE  sms.id IN ($_ids)";
		$result = \dash\pdo::get($query, [], null, false, 'api_log');
		return $result;
	}


	public static function sum_sms_sended_by_package_id($_business_id, $_package_id)
	{
		$query =
			"SELECT SUM(sms.smscount) AS `sum_sms_count` FROM sms WHERE  sms.store_id = :store_id AND sms.package_id = :package_id";

		$param = [':store_id' => $_business_id, ':package_id' => $_package_id];

		$result = \dash\pdo::get($query, $param, 'sum_sms_count', true, 'api_log');

		return $result;
	}


	/**
	 * Get last 200 sms pending to send from sms_sending table
	 */
	public static function not_sended_list()
	{
		$query  = "SELECT * FROM sms_sending WHERE  sms_sending.status = 'pending' LIMIT 200";
		$result = \dash\pdo::get($query, [], null, false, 'api_log');
		return $result;
	}


	public static function count_all()
	{
		return \dash\pdo\query_template::get_count('sms', [], 'api_log');

	}


	public static function count_all_sending()
	{
		return \dash\pdo\query_template::get_count('sms_sending', [], 'api_log');
	}


	public static function total_spent()
	{
		$query  =
			"SELECT SUM(sms.final_cost) AS `spent` FROM sms WHERE  sms.calculate_cost = 1 ";
		$param  = [];
		$result = \dash\pdo::get($query, $param, 'spent', true, 'api_log');
		return floatval($result);
	}


	public static function total_real_spent()
	{
		$query  =
			"SELECT SUM(sms.real_cost) AS `spent` FROM sms WHERE  sms.calculate_cost = 1 ";
		$param  = [];
		$result = \dash\pdo::get($query, $param, 'spent', true, 'api_log');
		return floatval($result);
	}


	public static function count_by_status()
	{
		$query  =
			"
				SELECT 
				    COUNT(*) AS `count`,
				    sms.status
				FROM 
				    sms 
				GROUP BY 
				    	sms.status
			";
		$param  = [];
		$result = \dash\pdo::get($query, $param, null, false, 'api_log');
		return $result;
	}


	public static function adminChart()
	{
		$query =
			'
				SELECT 
				    COUNT(*) AS `count`,
				    sms.status,
				    DATE(sms.datecreated) AS `categories`
				FROM 
				    sms
				GROUP BY `categories`, sms.status
			';

		$param =
			[
			];

		$result = \dash\pdo::get($query, $param, null, false, 'api_log');
		return $result;
	}

}
