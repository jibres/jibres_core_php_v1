<?php
namespace lib\db\business_domain;


class delete
{

	public static function all_domain_action($_id)
	{
		$query = "DELETE FROM business_domain_action WHERE business_domain_action.business_domain_id = $_id ";
		$result = \dash\db::query($query, 'master');
		return $result;
	}


	public static function dns_record($_id)
	{
		$query = "DELETE FROM business_domain_dns WHERE business_domain_dns.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'master');
		return $result;
	}

	public static function dns_record_by_user($_id)
	{
		$query = "UPDATE business_domain_dns SET business_domain_dns.status = 'pending_delete' WHERE business_domain_dns.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'master');
		return $result;
	}




	public static function all_domain_dns($_id)
	{
		$query = "DELETE FROM business_domain_dns WHERE business_domain_dns.business_domain_id = $_id ";
		$result = \dash\db::query($query, 'master');
		return $result;
	}

	public static function by_id($_id)
	{
		$query = "DELETE FROM business_domain WHERE business_domain.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'master');
		return $result;
	}




}
?>
