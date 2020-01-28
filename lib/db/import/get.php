<?php
namespace lib\db\import;


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
		$query   = "SELECT * FROM importexport WHERE importexport.mode = 'import' AND  DATE(importexport.datecreated) <= DATE('$_date')";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function check_duplicate($_type)
	{
		$query   = "SELECT * FROM importexport WHERE importexport.mode = 'import' AND importexport.type = '$_type' AND importexport.status IN ('awaiting', 'request', 'running') LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function get_last_awaiting($_type)
	{
		$query   = "SELECT * FROM importexport WHERE importexport.mode = 'import' AND importexport.type = '$_type' AND importexport.status = 'awaiting' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function check_day_limit($_type, $_date)
	{
		$query   = "SELECT COUNT(*) AS `count` FROM importexport WHERE importexport.mode = 'import' AND importexport.type = '$_type' AND DATE(importexport.datecreated) = DATE('$_date')";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function by_type($_type)
	{
		$query   = "SELECT * FROM importexport WHERE importexport.mode = 'import' AND importexport.type = '$_type' AND importexport.status NOT IN ('cancel', 'deleted', 'expire')";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function by_id($_id)
	{
		$query   = "SELECT * FROM importexport WHERE importexport.mode = 'import' AND importexport.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function awaiting_import($_type)
	{
		$query   = "SELECT * FROM importexport WHERE importexport.mode = 'import' AND importexport.type = '$_type' AND importexport.status = 'awaiting' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



}
?>