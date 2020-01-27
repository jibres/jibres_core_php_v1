<?php
namespace lib\db\export;


class get
{

	public static function count_all()
	{
		$query   = "SELECT COUNT(*) AS `count` FROM importexport ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function last_day_complete($_date)
	{
		$query   = "SELECT importexport.id AS `id` FROM importexport WHERE  DATE(importexport.datecreated) <= DATE('$_date')";
		$result = \dash\db::get($query, 'id');
		return $result;
	}

	public static function check_duplicate($_type)
	{
		$query   = "SELECT * FROM importexport WHERE importexport.type = '$_type' AND importexport.status IN ('request', 'running') LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function check_day_limit($_type, $_date)
	{
		$query   = "SELECT COUNT(*) AS `count` FROM importexport WHERE importexport.type = '$_type' AND DATE(importexport.datecreated) = DATE('$_date')";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function by_type($_type)
	{
		$query   = "SELECT * FROM importexport WHERE importexport.type = '$_type' AND importexport.status NOT IN ('cancel', 'deleted', 'expire')";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function by_id($_id)
	{
		$query   = "SELECT * FROM importexport WHERE importexport.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function any_running()
	{
		$query   = "SELECT * FROM importexport WHERE importexport.status = 'running' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function any_request()
	{
		$query   = "SELECT * FROM importexport WHERE importexport.status = 'request' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}




}
?>