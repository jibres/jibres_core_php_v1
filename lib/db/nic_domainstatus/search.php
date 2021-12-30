<?php
namespace lib\db\nic_domainstatus;

class search
{


	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\pdo\prepare_query::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM domainstatus $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\pagination::pagination_query($pagination_query, [], $q['limit'], 'nic');
		}

		$query = "SELECT * FROM domainstatus $q[where] $q[order] $limit ";

		$result = \dash\pdo::get($query, [], null, false, 'nic');

		return $result;
	}




}
?>