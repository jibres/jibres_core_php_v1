<?php
namespace lib\db\domains;


class search
{


	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\pdo\prepare_query::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM domains $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\pagination::pagination_query($pagination_query, $q['limit'], 'nic_log');
		}

		$query = "SELECT domains.* FROM domains $q[where] $q[order] $limit ";

		$result = \dash\pdo::get($query, [], null, false, 'nic_log');

		return $result;
	}



}
?>