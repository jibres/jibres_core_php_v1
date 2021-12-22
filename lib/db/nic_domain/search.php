<?php
namespace lib\db\nic_domain;

class search
{


	public static function count_list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);
		$query = "SELECT COUNT(*) AS `count` FROM domain $q[join] $q[where] ";
		$result = \dash\pdo::get($query, [], 'count', true, 'nic');
		return $result;
	}


	public static function calc_pay_period_predict($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$query = "SELECT domain.dateexpire, domain.id, domain.registrar, domain.name FROM domain $q[join] $q[where] $q[order] ";

		$result = \dash\pdo::get($query, [], null, false, 'nic');

		return $result;
	}


	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM domain $q[join] $q[where] ";

		$limit = null;
		if($q['pagination'] === false)
		{
			if($q['limit'])
			{
				$limit = " LIMIT $q[limit] ";
			}
		}
		else
		{
			$limit = \dash\db\pagination::pagination_query($pagination_query, $q['limit'], 'nic');
		}

		$query = "SELECT $q[fields] FROM domain $q[join] $q[where] $q[order] $limit ";

		$result = \dash\pdo::get($query, [], null, false, 'nic');

		return $result;
	}




}
?>