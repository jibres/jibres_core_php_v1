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


	public static function all_domain_store_id($_store_id)
	{
		$query  = " SELECT business_domain.domain, business_domain.master FROM business_domain WHERE business_domain.store_id = '$_store_id' AND business_domain.status NOT IN ('deleted', 'pending_delete', 'failed') ";
		$result = \dash\db::get($query, null, false, 'master');
		return $result;
	}


	public static function count_store_domain($_store_id)
	{
		$query  = " SELECT COUNT(*) AS `count` FROM business_domain WHERE business_domain.store_id = $_store_id ";
		$result = \dash\db::get($query, 'count', true, 'master');
		return floatval($result);
	}

	public static function count_domain_dns($_domain_id)
	{
		$query  = " SELECT COUNT(*) AS `count` FROM business_domain_dns WHERE business_domain_dns.business_domain_id = $_domain_id ";
		$result = \dash\db::get($query, 'count', true, 'master');
		return floatval($result);
	}






	public static function my_domain_not_connected_list($_user_id)
	{
		$query  =
		"
			SELECT
				jibres_nic.domain.name
			FROM
				jibres_nic.domain
			WHERE
				jibres_nic.domain.verify = 1 AND
				jibres_nic.domain.available = 0 AND
				jibres_nic.domain.status != 'deleted' AND
				jibres_nic.domain.user_id = $_user_id AND
				jibres_nic.domain.name NOT IN
				(
					SELECT jibres.business_domain.domain FROM jibres.business_domain
				)
			LIMIT 200
		";
		$result = \dash\db::get($query, null, false, 'master');

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
				business_domain.subdomain IS NULL AND
				business_domain.cdn != 'enterprise' AND
				business_domain.status = 'pending' AND
				business_domain.checkdns IS NULL
			ORDER BY
				business_domain.datemodified ASC
			LIMIT 10
		";
		$result = \dash\db::get($query, null, false, 'master');
		return $result;
	}



	public static function pending_dns_add()
	{
		$query  =
		"
			SELECT
				business_domain_dns.*
			FROM
				business_domain_dns
			WHERE
				business_domain_dns.status = 'pending'
			ORDER BY
				business_domain_dns.datemodified ASC
			LIMIT 2
		";
		$result = \dash\db::get($query, null, false, 'master');
		return $result;
	}

	public static function pending_dns_remove()
	{
		$query  =
		"
			SELECT
				business_domain_dns.*
			FROM
				business_domain_dns
			WHERE
				business_domain_dns.status = 'pending_delete'
			ORDER BY
				business_domain_dns.datemodified ASC
			LIMIT 10
		";
		$result = \dash\db::get($query, null, false, 'master');
		return $result;
	}




	public static function pending_domain_delete()
	{
		$query  =
		"
			SELECT
				business_domain.*
			FROM
				business_domain
			WHERE
				business_domain.status = 'pending_delete'
			ORDER BY
				business_domain.datemodified ASC
			LIMIT 1
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
				business_domain.subdomain IS NULL AND
				business_domain.cdn != 'enterprise' AND
				business_domain.status = 'pending' AND
				-- business_domain.checkdns IS NOT NULL AND
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
				business_domain.subdomain IS NULL AND
				business_domain.cdn != 'enterprise' AND
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
				business_domain.subdomain IS NULL AND
				business_domain.cdn != 'enterprise' AND
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


	public static function last_waiting_https_request($_date)
	{
		$query  =
		"
			SELECT
				business_domain.*
			FROM
				business_domain
			WHERE
				business_domain.subdomain IS NULL AND
				business_domain.cdn != 'enterprise' AND
				business_domain.status = 'pending' AND
				business_domain.checkdns IS NOT NULL AND
				business_domain.cdnpanel IS NOT NULL AND
				business_domain.httpsrequest IS NOT NULL AND
				business_domain.httpsrequest < '$_date' AND
				business_domain.httpsverify IS NULL
			ORDER BY
				business_domain.datemodified ASC
			LIMIT 5
		";

		$result = \dash\db::get($query, null, false, 'master');

		return $result;
	}


	public static function last_free_domains()
	{
		$query  =
		"
			SELECT
				business_domain.*
			FROM
				business_domain
			WHERE
				(
					business_domain.subdomain IS NOT NULL OR
					business_domain.cdn = 'enterprise'
				) AND
				business_domain.status = 'pending'
			ORDER BY
				business_domain.datemodified ASC
			LIMIT 10
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



	public static function count_all()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM business_domain";
		$result = \dash\db::get($query, 'count', true, 'master');
		return $result;
	}

	public static function count_ok()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM business_domain WHERE business_domain.status = 'ok' ";
		$result = \dash\db::get($query, 'count', true, 'master');
		return $result;
	}


	public static function count_pending()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM business_domain WHERE business_domain.status = 'pending' ";
		$result = \dash\db::get($query, 'count', true, 'master');
		return $result;
	}


	public static function count_failed()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM business_domain WHERE business_domain.status = 'failed' ";
		$result = \dash\db::get($query, 'count', true, 'master');
		return $result;
	}


	public static function count_action()
	{
		$query = "SELECT COUNT(*) AS `count` FROM business_domain_action";
		$result = \dash\db::get($query, 'count', true, 'master');
		return $result;
	}

	public static function count_cdn_ok()
	{
		$query = "SELECT COUNT(*) AS `count` FROM business_domain WHERE business_domain.cdnpanel IS NOT NULL ";
		$result = \dash\db::get($query, 'count', true, 'master');
		return $result;
	}

	public static function count_cdn_nok()
	{
		$query = "SELECT COUNT(*) AS `count` FROM business_domain WHERE business_domain.cdnpanel IS NULL ";
		$result = \dash\db::get($query, 'count', true, 'master');
		return $result;
	}

	public static function count_dns_resolved()
	{
		$query = "SELECT COUNT(*) AS `count` FROM business_domain WHERE business_domain.checkdns IS NOT NULL ";
		$result = \dash\db::get($query, 'count', true, 'master');
		return $result;
	}

	public static function count_dns_notresolved()
	{
		$query = "SELECT COUNT(*) AS `count` FROM business_domain WHERE business_domain.checkdns IS NULL ";
		$result = \dash\db::get($query, 'count', true, 'master');
		return $result;
	}

	public static function count_https_request()
	{
		$query = "SELECT COUNT(*) AS `count` FROM business_domain WHERE business_domain.httpsrequest IS NOT NULL ";
		$result = \dash\db::get($query, 'count', true, 'master');
		return $result;
	}

	public static function count_https_request_ok()
	{
		$query = "SELECT COUNT(*) AS `count` FROM business_domain WHERE business_domain.httpsverify IS NOT NULL ";
		$result = \dash\db::get($query, 'count', true, 'master');
		return $result;
	}

	public static function count_all_dns_record()
	{
		$query = "SELECT COUNT(*) AS `count` FROM business_domain_dns ";
		$result = \dash\db::get($query, 'count', true, 'master');
		return $result;
	}


	public static function count_all_dns_record_status($_status)
	{
		$query = "SELECT COUNT(*) AS `count` FROM business_domain_dns WHERE business_domain_dns.status = '$_status' ";
		$result = \dash\db::get($query, 'count', true, 'master');
		return $result;
	}






}
?>
