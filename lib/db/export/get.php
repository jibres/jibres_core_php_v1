<?php
namespace lib\db\export;


class get
{

	public static function count_all()
	{
		$query   = "SELECT COUNT(*) AS `count` FROM export ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function check_duplicate($_type)
	{
		$query   = "SELECT * FROM export WHERE export.type = '$_type' AND export.status IN ('request', 'running') LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function check_day_limit($_type, $_date)
	{
		$query   = "SELECT COUNT(*) AS `count` FROM export WHERE export.type = '$_type' AND DATE(export.datecreated) = DATE('$_date')";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function by_type($_type)
	{
		$query   = "SELECT * FROM export WHERE export.type = '$_type' AND export.status NOT IN ('cancel', 'deleted')";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function by_id($_id)
	{
		$query   = "SELECT * FROM export WHERE export.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function any_running()
	{
		$query   = "SELECT * FROM export WHERE export.status = 'running' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function any_request()
	{
		$query   = "SELECT * FROM export WHERE export.status = 'request' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}




}
?>