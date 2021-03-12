<?php
namespace lib\db\nic_domain;


class get
{


	public static function need_check_owner_again()
	{
		$date = date("Y-m-d H:i:s", strtotime("-1 days"));
		$query  =
		"
			SELECT
				*
			FROM
				domain
			WHERE
				domain.registrar = 'irnic' AND
				domain.email IS NULL AND
				domain.mobile IS NULL AND
				domain.ownercheckdate IS NOT NULL AND
				domain.ownercheckdate < '$date' AND
				domain.available != 1
			LIMIT 1
		";

		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}

	public static function not_checked_owner()
	{
		$query  =
		"
			SELECT
				*
			FROM
				domain
			WHERE
				domain.registrar = 'irnic' AND
				domain.email IS NULL AND
				domain.mobile IS NULL AND
				domain.ownercheckdate IS NULL AND
				domain.available != 1
			LIMIT 1
		";

		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}


	public static function count_group_by_nic_status($_user_id)
	{
		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				domainstatus.status
			FROM
				domainstatus
			WHERE
				domainstatus.domain IN (SELECT domain.name FROM domain WHERE domain.user_id = $_user_id AND domain.status != 'deleted' AND domain.verify = 1 and ( domain.available = 0 OR domain.available IS NULL))
			GROUP BY domainstatus.status
		";

		$result = \dash\db::get($query, ['status', 'count'], false, 'nic');
		return $result;
	}

	public static function user_list($_user_id)
	{
		$query  = "SELECT * FROM domain WHERE domain.user_id = $_user_id ORDER BY domain.id DESC";
		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}


	public static function by_id_user_id($_id, $_user_id)
	{
		$query  = "SELECT * FROM domain WHERE domain.id = $_id AND domain.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}




	public static function who_verify_enable_domain($_domain)
	{
		$query  = "SELECT * FROM domain WHERE domain.name = '$_domain' AND  domain.status = 'enable' AND  domain.verify = 1 LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}


	public static function check_multi_duplicate($_domains, $_user_id)
	{
		$my_domains = implode("','", $_domains);

		$query  = "SELECT domain.id, domain.name FROM domain WHERE domain.user_id = $_user_id AND domain.name IN ('$my_domains') AND domain.status != 'deleted' ";
		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}


	public static function by_id($_id)
	{
		$query  = "SELECT * FROM domain WHERE domain.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}

	public static function domain_anyone($_domain)
	{
		$query  =
		"
			SELECT * FROM domain WHERE domain.name = '$_domain'  LIMIT 1
		";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}


	public static function domain_user($_domain, $_user_id)
	{
		$query  =
		"
			SELECT * FROM domain WHERE domain.name = '$_domain' AND domain.user_id = $_user_id LIMIT 1
		";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;

	}


	public static function load_domain_user($_domain, $_user_id)
	{
		$query  =
		"
			SELECT * FROM domain WHERE domain.name = '$_domain' AND domain.user_id = $_user_id AND domain.status != 'deleted' LIMIT 1
		";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;

	}



	public static function check_duplicate($_user_id, $_nic_id)
	{
		$query  = "SELECT * FROM domain WHERE domain.user_id = $_user_id AND domain.nic_id = '$_nic_id' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}




	public static function count_all_my_domain($_user_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.user_id = $_user_id AND domain.status != 'deleted' ";
		$result = \dash\db::get($query, 'count', true, 'nic');
		return $result;
	}




	public static function maybe_my_domain_count($_user_id)
	{
		// $query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.user_id = $_user_id AND domain.status = 'enable' ";

		$query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.user_id = $_user_id AND ( domain.verify = 0 OR domain.verify IS NULL ) AND ( domain.available = 0 OR domain.available IS NULL) AND (domain.gateway IS NULL OR domain.gateway != 'import')  AND domain.status != 'deleted' ";
		$result = \dash\db::get($query, 'count', true, 'nic');
		return $result;
	}

	public static function my_available_count($_user_id)
	{
		// $query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.user_id = $_user_id AND domain.status = 'enable' ";
		$query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.user_id = $_user_id AND domain.available = 1 AND domain.status != 'deleted' ";
		$result = \dash\db::get($query, 'count', true, 'nic');
		return $result;
	}


	public static function my_imported_count($_user_id)
	{
		// $query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.user_id = $_user_id AND domain.status = 'enable' ";
		$query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.user_id = $_user_id AND domain.gateway = 'import' AND ( domain.available = 0 OR domain.available IS NULL)  AND ( domain.verify = 0 OR domain.verify IS NULL ) AND domain.status != 'deleted' ";
		$result = \dash\db::get($query, 'count', true, 'nic');
		return $result;
	}





	public static function my_lock_count($_user_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.user_id = $_user_id AND domain.verify = 1 AND ( domain.available = 0 OR domain.available IS NULL) AND domain.status != 'deleted' AND domain.lock = 1 ";
		$result = \dash\db::get($query, 'count', true, 'nic');
		return $result;
	}


	public static function notif_expire($_date)
	{
		$query  = "SELECT * FROM domain WHERE domain.status != 'deleted' AND ( domain.autorenew = 0 OR domain.autorenew IS NULL) AND DATE(domain.dateexpire) = DATE('$_date') ";
		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}

	public static function count_expire_domain_date($_user_id, $_date)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.user_id = $_user_id AND domain.status != 'deleted' AND domain.verify = 1 AND domain.autorenew = 1  AND DATE(domain.dateexpire) <= DATE('$_date') ";
		$result = \dash\db::get($query, 'count', true, 'nic');
		return $result;
	}



}
?>