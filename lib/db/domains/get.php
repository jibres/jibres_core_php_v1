<?php
namespace lib\db\domains;


class get
{

	public static function count_all()
	{
		$query   = "SELECT COUNT(*) AS `count` FROM domains ";
		$result = \dash\db::get($query, 'count', true, 'nic_log');
		return $result;
	}


	public static function check_exists($_domain)
	{
		$query   = "SELECT * FROM domains WHERE domains.domain = '$_domain' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic_log');
		return $result;
	}
}
?>