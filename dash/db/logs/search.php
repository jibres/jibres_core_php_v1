<?php
namespace dash\db\logs;

class search
{
	public static function list($_param, $_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\pdo\prepare_query::binded_ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM logs LEFT JOIN users ON users.id = logs.from $q[where]  ";

		$limit = \dash\db\pagination::pagination_query($pagination_query, $_param, $q['limit']);

		$query =
		"
			SELECT
				logs.*,
				users.mobile      AS `mobile`,
				users.displayname AS `displayname`,
				users.avatar AS `avatar`
			FROM
				logs
			LEFT JOIN users ON users.id = logs.from
			$q[where] $q[order] $limit ";

		$result = \dash\pdo::get($query, $_param);

		return $result;
	}



}
?>