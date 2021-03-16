<?php
namespace lib\db\giftusage;


class get
{


	public static function count_usage()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM giftusage ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function count_usage_id($_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM giftusage WHERE giftusage.gift_id = $_id";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function last_usage_id($_id)
	{
		$query  = "SELECT * FROM giftusage WHERE giftusage.gift_id = $_id ORDER BY giftusage.id DESC LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function first_usage_id($_id)
	{
		$query  = "SELECT * FROM giftusage WHERE giftusage.gift_id = $_id ORDER BY giftusage.id ASC LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function count_usage_user_id($_id)
	{
		$query  = "SELECT SUM(mycount.count) AS `mycountuser` FROM (SELECT 1 AS `count` FROM giftusage WHERE giftusage.gift_id = $_id GROUP BY giftusage.user_id) AS `mycount`";
		$result = \dash\db::get($query, 'mycountuser', true);
		return $result;
	}



}
?>