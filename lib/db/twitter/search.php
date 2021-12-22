<?php
namespace lib\db\twitter;


class search
{

	public static function list($_and = null, $_or = null, $_order_sort = null, $_meta = [])
	{

		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =	"SELECT COUNT(*) AS `count`	FROM twitter $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\pagination::pagination_query($pagination_query, $q['limit'], 'api_log');
		}

		$query =
		"
			SELECT
				*
			FROM twitter
			$q[where]
			$q[order]
			$limit
		";

		$result = \dash\pdo::get($query, [], null, false,  'api_log');


		return $result;

	}
}
?>