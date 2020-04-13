<?php
namespace lib\db\nic_domainbilling;


class get
{

	public static function sale_count_date($_date = null)
	{
		$date = null;
		if($_date)
		{
			$date = " AND DATE(domainbilling.date) > DATE('$_date') ";
		}

		$query  = "SELECT COUNT(*) AS `count` FROM domainbilling WHERE domainbilling.action IN ('register', 'transfer', 'renew') $date";

		$result = \dash\db::get($query, 'count', true, 'nic');

		return $result;
	}


	public static function total_buyers()
	{
		$query  = "SELECT SUM(myCount.i) AS `count` FROM (SELECT 1 AS `i` FROM domainbilling WHERE domainbilling.action IN ('register', 'transfer', 'renew') GROUP BY domainbilling.user_id) AS `myCount` ";
		$result = \dash\db::get($query, 'count', true, 'nic');
		return $result;
	}


	public static function count_group_by_action()
	{
		$query  = "SELECT COUNT(*) AS `count`, domainbilling.action FROM domainbilling  WHERE domainbilling.action IN ('register', 'transfer', 'renew') GROUP BY domainbilling.action";
		$result = \dash\db::get($query, ['action', 'count'], false, 'nic');
		return $result;
	}


	public static function chart_domain_action($_date)
	{
		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				domainbilling.action,
				DATE(domainbilling.date) AS `date`
			FROM
				domainbilling
			WHERE
				domainbilling.action IN ('register', 'transfer', 'renew') AND
				DATE(domainbilling.date) > DATE('$_date')
			GROUP BY
				domainbilling.action,
				DATE(domainbilling.date)
		";

		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}
}
?>
