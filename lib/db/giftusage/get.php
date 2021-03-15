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

}
?>