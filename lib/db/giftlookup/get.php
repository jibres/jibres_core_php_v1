<?php
namespace lib\db\giftlookup;


class get
{


	public static function count_lookup()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM giftlookup ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function count_lookupfaild()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM giftlookup WHERE giftlookup.valid != 'yes' ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}
}
?>