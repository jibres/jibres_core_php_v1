<?php
namespace lib\db\store_sms;


class get
{



	public static function by_id($_id)
	{
		$query  = "SELECT * FROM store_sms WHERE  store_sms.id = $_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true, 'api_log');
		return $result;
	}

}
?>
