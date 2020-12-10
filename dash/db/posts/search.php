<?php
namespace dash\db\posts;

class search
{
	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM posts $q[where]  ";

		$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);

		$query =
		"
			SELECT
				posts.*

			FROM
				posts
			$q[where] $q[order] $limit ";

		$result = \dash\db::get($query);

		return $result;
	}


	public static function random_help_center()
	{
		$query  = "SELECT * FROM posts WHERE posts.type = 'help' AND posts.status = 'publish' ORDER BY RAND() LIMIT 5 ";
		$result = \dash\db::get($query);
		return $result;
	}


}
?>
