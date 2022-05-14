<?php
namespace dash\db\tickets;

class search
{
	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\pdo\prepare_query::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM tickets LEFT JOIN users ON users.id = tickets.user_id $q[where]  ";

		$limit = \dash\db\pagination::pagination_query($pagination_query, [], $q['limit']);

		$query =
		"
			SELECT
				tickets.*,
				users.mobile      AS `mobile`,
				users.displayname AS `displayname`,
				users.avatar AS `avatar`
			FROM
				tickets
				$q[join]
			LEFT JOIN users ON users.id = tickets.user_id
			$q[where] $q[order] $limit ";

		$result = \dash\pdo::get($query);

		return $result;
	}



}
?>