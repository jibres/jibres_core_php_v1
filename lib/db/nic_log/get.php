<?php
namespace lib\db\nic_log;


class get
{

	public static function by_id($_id)
	{
		$query  = "SELECT log.* FROM log  WHERE log.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic_log');
		return $result;
	}


	public static function group_by_type()
	{
		$query  = "SELECT COUNT(*) AS `count`, log.type FROM log  GROUP BY log.type";
		$result = \dash\db::get($query, null, false, 'nic_log');
		return $result;
	}

	public static function group_by_code()
	{
		$query  = "SELECT COUNT(*) AS `count`, log.result_code FROM log  GROUP BY log.result_code";
		$result = \dash\db::get($query, null, false, 'nic_log');
		return $result;
	}


	public static function count_request_in_day($_date)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM log WHERE DATE(log.datesend) = DATE('$_date')";
		$result = \dash\db::get($query, 'count', true, 'nic_log');
		return $result;
	}
}
?>