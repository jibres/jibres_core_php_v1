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

}
?>
