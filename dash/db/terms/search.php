<?php
namespace dash\db\terms;

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

			$pagination_query = "SELECT COUNT(*) AS `count` FROM terms $q[where]  ";
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}


		$query =
		"
			SELECT
				terms.*,
				(SELECT COUNT(*) FROM termusages WHERE termusages.term_id = terms.id) AS `count`
			FROM
				terms
			$q[where] $q[order] $limit ";

		$result = \dash\db::get($query);

		return $result;
	}
}
?>