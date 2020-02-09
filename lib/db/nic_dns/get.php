<?php
namespace lib\db\nic_dns;


class get
{
	public static function user_list($_user_id)
	{
		$query  = "SELECT * FROM dns WHERE dns.user_id = $_user_id ORDER BY dns.id DESC";
		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}

	public static function by_id_user_id($_id, $_user_id)
	{
		$query  = "SELECT * FROM dns WHERE dns.id = $_id AND dns.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}


	public static function check_duplicate($_user_id)
	{
		$query  = "SELECT * FROM dns WHERE dns.user_id = $_user_id  LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}
}
?>