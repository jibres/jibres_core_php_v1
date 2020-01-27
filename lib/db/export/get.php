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