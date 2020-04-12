<?php
namespace lib\db\nic_domainaction;


class get
{


	public static function sale_count_date($_date = null)
	{
		$date = null;
		if($_date)
		{
			$date = " AND DATE(domainaction.date) > DATE('$_date') ";
		}

		$query  = "SELECT COUNT(*) AS `count` FROM domainaction WHERE domainaction.action = 'register' $date";

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




}
?>
