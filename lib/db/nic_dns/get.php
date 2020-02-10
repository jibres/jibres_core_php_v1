<?php
namespace lib\db\nic_dns;


class get
{
	public static function user_list($_user_id)
	{
		$query  = "SELECT dns.*, (SELECT COUNT(*) FROM domain WHERE domain.dns = dns.id) AS `count_useage`  FROM dns WHERE dns.user_id = $_user_id AND dns.status != 'deleted' ORDER BY dns.id DESC";
		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}

	public static function by_id_user_id($_id, $_user_id)
	{
		$query  = "SELECT dns.*, (SELECT COUNT(*) FROM domain WHERE domain.dns = dns.id) AS `count_useage`  FROM dns WHERE dns.id = $_id AND dns.user_id = $_user_id AND dns.status != 'deleted' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}

}
?>