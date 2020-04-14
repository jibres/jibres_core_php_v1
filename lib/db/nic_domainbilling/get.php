<?php
namespace lib\db\nic_domainbilling;


class get
{
	public static function my_total_payed($_user_id, $_date = null)
	{
		$date = null;
		if($_date)
		{
			$date = " AND DATE(domainbilling.datecreated) > DATE('$_date') ";
		}

		$query  = "SELECT SUM(domainbilling.price) AS `price` FROM domainbilling WHERE domainbilling.user_id = $_user_id WHERE 1 $date";

		$result = \dash\db::get($query, 'price', true, 'nic');

		return $result;
	}


	public static function chart_my_pay($_user_id)
	{
		$query  =
		"
			SELECT
				SUM(domainbilling.price) AS `price`,
				MONTH(domainbilling.datecreated) AS `month`,
				YEAR(domainbilling.datecreated) AS `year`
			FROM
				domainbilling
			WHERE
				domainbilling.user_id = $_user_id
			GROUP BY
				`month`,`year`
		";

		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}


		public static function sale_count_date($_date = null)
	{
		$date = null;
		if($_date)
		{
			$date = " AND DATE(domainbilling.date) > DATE('$_date') ";
		}

		$query  = "SELECT COUNT(*) AS `count` FROM domainbilling WHERE 1 $date";

		$result = \dash\db::get($query, 'count', true, 'nic');

		return $result;
	}



	public static function count_group_by_action()
	{
		$query  = "SELECT COUNT(*) AS `count`, domainbilling.action FROM domainbilling  GROUP BY domainbilling.action";
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
				DATE(domainbilling.datecreated) AS `date`
			FROM
				domainbilling
			WHERE
				DATE(domainbilling.datecreated) > DATE('$_date')
			GROUP BY
				domainbilling.action,
				DATE(domainbilling.datecreated)
		";

		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}
}
?>
