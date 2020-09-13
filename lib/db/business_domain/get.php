<?php
namespace lib\db\business_domain;


class get
{


	public static function by_domain($_domain)
	{
		$query  = " SELECT * FROM business_domain WHERE business_domain.domain = '$_domain' LIMIT 1 ";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}


	public static function by_id($_id)
	{
		$query  = " SELECT * FROM business_domain WHERE business_domain.id = $_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}


	public static function action_count($_id)
	{
		$query  = " SELECT COUNT(*) AS `count` FROM business_domain_action WHERE business_domain_action.business_domain_id = $_id ";
		$result = \dash\db::get($query, 'count', true, 'master');
		return $result;
	}


	public static function dns_count($_id)
	{
		$query  = " SELECT COUNT(*) AS `count` FROM business_domain_dns WHERE business_domain_dns.business_domain_id = $_id ";
		$result = \dash\db::get($query, 'count', true, 'master');
		return $result;
	}

	public static function dns_list($_id)
	{
		$query  = " SELECT * FROM business_domain_dns WHERE business_domain_dns.business_domain_id = $_id ORDER BY business_domain_dns.id DESC";
		$result = \dash\db::get($query, null, false, 'master');
		return $result;
	}

	public static function dns_record($_id)
	{
		$query  = " SELECT * FROM business_domain_dns WHERE business_domain_dns.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}


	public static function dns_where_one($_where)
	{
		$where = \dash\db\config::make_where($_where);
		$query  = " SELECT * FROM business_domain_dns WHERE $where LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}

}
?>
