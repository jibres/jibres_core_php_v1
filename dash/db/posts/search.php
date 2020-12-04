<?php
namespace dash\db\posts;

class search
{
	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM posts LEFT JOIN users ON users.id = posts.user_id $q[where]  ";

		$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);

		$query =
		"
			SELECT
				posts.*,
				users.mobile      AS `mobile`,
				users.displayname AS `displayname`,
				users.avatar AS `avatar`
			FROM
				posts
			LEFT JOIN users ON users.id = posts.user_id
			$q[where] $q[order] $limit ";

		$result = \dash\db::get($query);

		return $result;
	}


}
?>
