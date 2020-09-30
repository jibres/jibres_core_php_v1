<?php
namespace lib\db\business_domain;

class search
{

	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM business_domain $q[join] $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit'], 'master');
		}

		$query =
		"
			SELECT
				business_domain.*,
				store_data.title,
				store_data.logo,
				(SELECT COUNT(*) FROM business_domain_action WHERE business_domain_action.business_domain_id = business_domain.id) AS `count_log`,
				(SELECT COUNT(*) FROM business_domain_dns WHERE business_domain_dns.business_domain_id = business_domain.id) AS `count_dns`,
				(SELECT business_domain_action.datecreated FROM business_domain_action WHERE business_domain_action.business_domain_id = business_domain.id ORDER BY business_domain_action.id DESC LIMIT 1) AS `last_log_time`
			FROM
				business_domain
			$q[join]
			$q[where]
			$q[order]
			$limit
		";

		$result = \dash\db::get($query, null, false, 'master');

		return $result;
	}

	public static function list_action($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM business_domain_action $q[join] $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit'], 'master');
		}

		$query = "SELECT business_domain_action.*, business_domain.domain FROM business_domain_action $q[join] $q[where] $q[order] $limit ";

		$result = \dash\db::get($query, null, false, 'master');

		return $result;
	}


	public static function list_dns($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM business_domain_dns $q[join] $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit'], 'master');
		}

		$query = "SELECT business_domain_dns.*, business_domain.domain FROM business_domain_dns $q[join] $q[where] $q[order] $limit ";

		$result = \dash\db::get($query, null, false, 'master');

		return $result;
	}




}
?>