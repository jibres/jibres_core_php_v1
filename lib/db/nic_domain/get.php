<?php
namespace lib\db\nic_domain;


class get
{
	public static function user_list($_user_id)
	{
		$query  = "SELECT * FROM domain WHERE domain.user_id = $_user_id ORDER BY domain.id DESC";
		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}


	public static function by_id_user_id($_id, $_user_id)
	{
		$query  = "SELECT domain.*, domain.id AS `id`, dns.ns1, dns.ns2, dns.ns3, dns.ns4, dns.ip1, dns.ip2, dns.ip3, dns.ip4
		FROM domain LEFT JOIN dns ON dns.id = domain.dns WHERE domain.id = $_id AND domain.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}


	public static function check_multi_duplicate($_domains, $_user_id)
	{
		$my_domains = implode("','", $_domains);

		$query  = "SELECT domain.id, domain.name FROM domain WHERE domain.user_id = $_user_id AND domain.name IN ('$my_domains') AND domain.status = 'enable' ";
		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}


	public static function by_id($_id)
	{
		$query  = "SELECT domain.*, domain.id AS `id`, dns.ns1, dns.ns2, dns.ns3, dns.ns4, dns.ip1, dns.ip2, dns.ip3, dns.ip4
		FROM domain LEFT JOIN dns ON dns.id = domain.dns WHERE domain.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}

	public static function domain_anyone($_domain)
	{
		$query  =
		"
			SELECT domain.*, domain.id AS `id`, dns.ns1, dns.ns2, dns.ns3, dns.ns4, dns.ip1, dns.ip2, dns.ip3, dns.ip4
			FROM domain LEFT JOIN dns ON dns.id = domain.dns WHERE domain.name = '$_domain'  LIMIT 1
		";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}


	public static function domain_user($_domain, $_user_id)
	{
		$query  =
		"
			SELECT domain.*, domain.id AS `id`, dns.ns1, dns.ns2, dns.ns3, dns.ns4, dns.ip1, dns.ip2, dns.ip3, dns.ip4
			FROM domain LEFT JOIN dns ON dns.id = domain.dns WHERE domain.name = '$_domain' AND domain.user_id = $_user_id LIMIT 1
		";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;

	}


	public static function count_usage_dns($_dns_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.dns = '$_dns_id' AND domain.status = 'enable' ";
		$result = \dash\db::get($query, 'count', true, 'nic');
		return $result;
	}



	public static function check_duplicate($_user_id, $_nic_id)
	{
		$query  = "SELECT * FROM domain WHERE domain.user_id = $_user_id AND domain.nic_id = '$_nic_id' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}




	public static function my_active_count($_user_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.user_id = $_user_id AND domain.status = 'enable' ";
		$result = \dash\db::get($query, 'count', true, 'nic');
		return $result;
	}


	public static function my_deactive_count($_user_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.user_id = $_user_id AND domain.status NOT IN ('deleted', 'enable') ";
		$result = \dash\db::get($query, 'count', true, 'nic');
		return $result;
	}

}
?>