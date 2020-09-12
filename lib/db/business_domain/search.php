<?php
namespace lib\db\business_domain;

class search
{

	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM business_domain $q[join] $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query = "SELECT business_domain.*, store_data.title, store_data.logo FROM business_domain $q[join] $q[where] $q[order] $limit ";

		$result = \dash\db::get($query);

		return $result;
	}




}
?>