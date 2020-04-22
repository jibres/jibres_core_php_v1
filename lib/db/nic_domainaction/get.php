<?php
namespace lib\db\nic_domainaction;


class get
{



	public static function firstrenew_user($_user_id)
	{
		$query  = "SELECT * FROM domainaction  WHERE domainaction.action = 'renew' AND domainaction.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}


	public static function sale_count_date($_date = null)
	{
		$date = null;
		if($_date)
		{
			$date = " AND DATE(domainaction.date) > DATE('$_date') ";
		}

		$query  = "SELECT COUNT(*) AS `count` FROM domainaction WHERE domainaction.action IN ('register', 'transfer', 'renew') $date";

		$result = \dash\db::get($query, 'count', true, 'nic');

		return $result;
	}


	public static function total_buyers()
	{
		$query  = "SELECT SUM(myCount.i) AS `count` FROM (SELECT 1 AS `i` FROM domainaction WHERE domainaction.action IN ('register', 'transfer', 'renew') GROUP BY domainaction.user_id) AS `myCount` ";
		$result = \dash\db::get($query, 'count', true, 'nic');
		return $result;
	}


	public static function count_group_by_action()
	{
		$query  = "SELECT COUNT(*) AS `count`, domainaction.action FROM domainaction  WHERE domainaction.action IN ('register', 'transfer', 'renew') GROUP BY domainaction.action";
		$result = \dash\db::get($query, ['action', 'count'], false, 'nic');
		return $result;
	}


	public static function last_record_domain_id_caller($_id, $_action)
	{
		$query  =
		"
			SELECT
				*
			FROM
				domainaction
			WHERE
				domainaction.domain_id = $_id AND
				domainaction.action    = '$_action'
			ORDER BY
				domainaction.id DESC
			LIMIT 1
		";

		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}

	public static function last_record_domain_id($_id)
	{
		$query  =
		"
			SELECT
				*
			FROM
				domainaction
			WHERE
				domainaction.domain_id = $_id
			ORDER BY
				domainaction.id DESC
			LIMIT 1
		";

		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}


	public static function caller_domain_user_id_date($_caller, $_domain, $_user_id, $_date)
	{
		$query  =
		"
			SELECT
				*
			FROM
				domainaction
			WHERE
				domainaction.user_id           = $_user_id AND
				domainaction.action            = '$_caller' AND
				domainaction.domainname        = '$_domain' AND
				DATE(domainaction.datecreated) = DATE('$_date')
			LIMIT 1
		";

		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}


	public static function chart_domain_action($_date)
	{
		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				domainaction.action,
				DATE(domainaction.date) AS `date`
			FROM
				domainaction
			WHERE
				domainaction.action IN ('register', 'transfer', 'renew') AND
				DATE(domainaction.date) > DATE('$_date')
			GROUP BY
				domainaction.action,
				DATE(domainaction.date)
		";

		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}
}
?>
