<?php
namespace dash\db\logs;

class get
{
	public static function by_caller_code($_caller, $_code)
	{
		$query = " SELECT logs.* FROM logs WHERE logs.caller = '$_caller' AND logs.code = '$_code' LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function by_id($_id)
	{
		$query = " SELECT * FROM logs WHERE logs.id = $_id  LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function notif_by_id($_id)
	{
		$query = " SELECT * FROM logs WHERE logs.id = $_id AND logs.notif = 1 LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



}
?>