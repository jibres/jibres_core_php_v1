<?php
namespace lib\db\nic_domain;


class get
{

	public static function autorenew_list($_date, $_hour)
	{
		$query  =
		"
			SELECT
				domain.*,
				usersetting.autorenewperiod,
				usersetting.domainlifetime,
				domain.id AS `id`
			FROM
				domain
			LEFT JOIN usersetting ON usersetting.user_id = domain.user_id
			WHERE
				domain.autorenew = 1 AND
				DATE(domain.dateexpire) < DATE('$_date') AND
				HOUR(domain.dateexpire) = '$_hour'
			ORDER BY
				domain.id ASC
		";
		$result = \dash\db::get($query, null, false, 'nic');
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

		$query  = "SELECT domain.id, domain.name FROM domain WHERE domain.user_id = $_user_id AND domain.name IN ('$my_domains') AND domain.status = 'enable' ";
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


	public static function my_active_count($_user_id)
	{
		// $query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.user_id = $_user_id AND domain.status = 'enable' ";
		$query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.user_id = $_user_id AND domain.verify = 1 AND domain.available = 0 AND domain.status != 'deleted' ";
		$result = \dash\db::get($query, 'count', true, 'nic');
		return $result;
	}


	public static function my_deactive_count($_user_id)
	{
		// $query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.user_id = $_user_id AND domain.status NOT IN ('deleted', 'enable') ";
		$query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.user_id = $_user_id AND ( domain.verify = 0 OR domain.verify IS NULL OR domain.available = 1 OR domain.available IS NULL ) AND domain.status != 'deleted' ";
		$result = \dash\db::get($query, 'count', true, 'nic');
		return $result;
	}




	public static function my_autorenew_count($_user_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.user_id = $_user_id AND domain.status != 'deleted' AND domain.autorenew = 1 ";
		$result = \dash\db::get($query, 'count', true, 'nic');
		return $result;
	}


	public static function my_lock_count($_user_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.user_id = $_user_id AND domain.status != 'enable' AND domain.lock = 1 ";
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
		$query  = "SELECT COUNT(*) AS `count` FROM domain WHERE domain.status != 'deleted' AND domain.user_id = $_user_id AND DATE(domain.dateexpire) <= DATE('$_date') ";
		$result = \dash\db::get($query, 'count', true, 'nic');
		return $result;
	}



}
?>