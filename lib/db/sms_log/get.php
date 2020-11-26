<?php
namespace lib\db\sms_log;

class get
{

	public static function by_id($_id)
	{
		$query = "SELECT * FROM sms_log WHERE sms_log.id = $_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

}
?>