<?php
namespace dash\db\telegrams;


class get
{
	public static function by_id($_id)
	{
		$query  = "SELECT * FROM telegrams WHERE telegrams.id = $_id  LIMIT 1 ";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function by_multi_id(string $_ids)
	{
		$query  = "SELECT * FROM telegram WHERE  telegram.id IN ($_ids)";
		$result = \dash\pdo::get($query, [], null, false, 'api_log');
		return $result;
	}



	public static function not_sended_list()
	{
		$query  = "SELECT * FROM telegram_sending WHERE telegram_sending.status = 'pending'  LIMIT 100 ";
		$result = \dash\pdo::get($query, [], null, true, 'api_log');
		return $result;
	}


	public static function api_by_id($_id)
	{
		$query  = "SELECT * FROM telegram WHERE telegram.id = $_id  LIMIT 1 ";
		$result = \dash\pdo::get($query, [], null, true, 'api_log');
		return $result;
	}



}
?>