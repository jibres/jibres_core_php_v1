<?php
namespace dash\db\users;

class search
{
	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM users $q[where]  ";

		$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);

		$query =
		"
			SELECT
				users.*
			FROM
				users
			$q[where] $q[order] $limit ";

		$result = \dash\db::get($query);

		return $result;
	}



}
?>