<?php
namespace lib\db\nic_domainaction;

class search
{


	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\pdo\prepare_query::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM domainaction $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\pagination::pagination_query($pagination_query, [], $q['limit'], 'nic');
		}

		$query = "SELECT domainaction.*, domain.name, domain.verify FROM domainaction LEFT JOIN domain ON domain.id = domainaction.domain_id $q[where] $q[order] $limit ";

		$result = \dash\pdo::get($query, [], null, false, 'nic');

		return $result;
	}




}
?>