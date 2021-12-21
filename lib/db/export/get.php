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
		$query   = "SELECT * FROM importexport WHERE importexport.mode = 'export' AND  DATE(importexport.datecreated) <= DATE('$_date')";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function check_duplicate_where($_where)
	{
		$where = \dash\db\config::make_where($_where);
		$query   = "SELECT * FROM importexport WHERE importexport.mode = 'export' AND $where AND importexport.status IN ('request', 'running') ORDER BY importexport.id DESC LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function check_duplicate($_type)
	{
		$query   = "SELECT * FROM importexport WHERE importexport.mode = 'export' AND importexport.type = '$_type' AND importexport.status IN ('request', 'running') ORDER BY importexport.id DESC LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function check_day_limit($_type, $_date)
	{
		$query   = "SELECT COUNT(*) AS `count` FROM importexport WHERE importexport.mode = 'export' AND importexport.type = '$_type' AND DATE(importexport.datecreated) = DATE('$_date')";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}





	public static function by_type_related_id($_type, $_related_id)
	{
		$query   = "SELECT * FROM importexport WHERE importexport.mode = 'export' AND importexport.type = '$_type' AND importexport.status NOT IN ('cancel', 'deleted', 'expire') AND importexport.related_id = $_related_id ";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function by_type($_type)
	{
		$query   = "SELECT * FROM importexport WHERE importexport.mode = 'export' AND importexport.type = '$_type' AND importexport.status NOT IN ('cancel', 'deleted', 'expire')";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function by_id($_id)
	{
		$query   = "SELECT * FROM importexport WHERE importexport.mode = 'export' AND importexport.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function any_running()
	{
		$query   = "SELECT * FROM importexport WHERE importexport.mode = 'export' AND importexport.status = 'running' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function any_request()
	{
		$query   = "SELECT * FROM importexport WHERE importexport.mode = 'export' AND importexport.status = 'request' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}




}
?>