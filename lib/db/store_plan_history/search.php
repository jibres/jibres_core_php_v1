<?php
namespace lib\db\store_plan_history;

class search
{

	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\pdo\prepare_query::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM store_plan_history $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\pagination::pagination_query($pagination_query, [], $q['limit']);
		}

		$query = "SELECT store_plan_history.*,store_data.title,store_data.logo FROM store_plan_history LEFT JOIN store_data ON store_data.id = store_plan_history.store_id $q[where] $q[order] $limit ";

		$result = \dash\pdo::get($query);

		return $result;
	}




}
?>