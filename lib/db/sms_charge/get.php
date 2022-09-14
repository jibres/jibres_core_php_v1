<?php
namespace lib\db\sms_charge;


class get
{


	public static function by_id($_id)
	{
		$query  = "SELECT * FROM sms_charge WHERE  sms_charge.id = $_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true, 'api_log');
		return $result;
	}


}
