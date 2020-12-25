<?php
namespace dash\db\comments;

class search
{
	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		if($q['pagination'] === false)
		{
			if($q['limit'])
			{
				$limit = "LIMIT $q[limit] ";
			}
			else
			{
				$limit = "LIMIT 100 ";
			}
		}
		else
		{
			$pagination_query = "SELECT COUNT(*) AS `count` FROM comments $q[join] $q[where]  ";
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}


		$query =
		"
			SELECT
				comments.*,
				users.displayname AS `user_displayname`,
				users.mobile AS `user_mobile`,
				users.avatar AS `avatar`
			FROM
				comments
			LEFT JOIN users ON users.id = comments.user_id
			$q[join]
			$q[where]
			$q[order]
			$limit
		";
		$result = \dash\db::get($query);

		return $result;
	}
}
?>