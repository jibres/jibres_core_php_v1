<?php
namespace dash\db\mysql\tools;

class info
{

	public static function global_setting()
	{
		$query = " SHOW GLOBAL VARIABLES ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function timeout_setting()
	{
		$query = " SHOW GLOBAL VARIABLES LIKE '%wait%'";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>