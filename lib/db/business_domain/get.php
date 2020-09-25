<?php
namespace lib\db\business_domain;


class get
{
	// check domain in list in route customer domain
	public static function check_is_customer_domain($_domain)
	{
		$query  = " SELECT * FROM business_domain WHERE business_domain.domain = '$_domain' LIMIT 1 ";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}



	public static function have_pending_domain()
	{
		$query  = " SELECT * FROM business_domain WHERE business_domain.status = 'pending' LIMIT 1 ";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}

	public static function last_domain_not_resolved()
	{
		$query  =
		"
			SELECT
				business_domain.*,
				(
					SELECT
						business_domain_action.datecreated
					FROM
						business_domain_action
					WHERE
						business_domain_action.business_domain_id = business_domain.id AND
						business_domain_action.action = 'dns_failed'
					ORDER BY
						business_domain_action.id DESC
					LIMIT 1
				) AS `last_action_time`
			FROM
				business_domain
			WHERE
				business_domain.status = 'pending' AND
				business_domain.checkdns IS NULL
			ORDER BY
				business_domain.datemodified ASC
			LIMIT 10
		";
		$result = \dash\db::get($query, null, false, 'master');
		return $result;
	}


	public static function last_not_added_to_cdn_panel()
	{
		$query  =
		"
			SELECT
				business_domain.*
			FROM
				business_domain
			WHERE
				business_domain.status = 'pending' AND
				business_domain.checkdns IS NOT NULL AND
				business_domain.cdnpanel IS NULL
			ORDER BY
				business_domain.datemodified ASC
			LIMIT 1
		";
		$result = \dash\db::get($query, null, false, 'master');
		return $result;
	}



	public static function last_not_add_dns_record()
	{
		$query  =
		"
			SELECT
				business_domain.*
			FROM
				business_domain
			WHERE
				business_domain.status = 'pending' AND
				business_domain.checkdns IS NOT NULL AND
				business_domain.cdnpanel IS NOT NULL
			ORDER BY
				business_domain.datemodified ASC
			LIMIT 2
		";
		$result = \dash\db::get($query, null, false, 'master');
		return $result;
	}


	public static function last_not_send_https_request()
	{
		$query  =
		"
			SELECT
				business_domain.*
			FROM
				business_domain
			WHERE
				business_domain.status = 'pending' AND
				business_domain.checkdns IS NOT NULL AND
				business_domain.cdnpanel IS NOT NULL AND
				business_domain.httpsrequest IS NULL
			ORDER BY
				business_domain.datemodified ASC
			LIMIT 3
		";
		$result = \dash\db::get($query, null, false, 'master');
		return $result;
	}








	public static function by_store_id_master_domain($_store_id)
	{
		$query  = " SELECT * FROM business_domain WHERE business_domain.store_id = $_store_id AND business_domain.master = 1 LIMIT 1 ";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}


	public static function by_store_id($_store_id)
	{
		$query  = " SELECT * FROM business_domain WHERE business_domain.store_id = $_store_id ";
		$result = \dash\db::get($query, null, false, 'master');
		return $result;
	}


	public static function by_store_id_domain($_store_id, $_domain)
	{
		$query  = " SELECT * FROM business_domain WHERE business_domain.store_id = $_store_id AND business_domain.domain = '$_domain' LIMIT 1 ";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}


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
