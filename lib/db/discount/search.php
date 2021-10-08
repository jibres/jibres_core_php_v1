<?php
namespace lib\db\discount;


class search
{
	public static function list($_and = null, $_or = null, $_order_sort = null, $_meta = [])
	{

		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =	"SELECT COUNT(*) AS `count`	FROM discount $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}
		else
		{
			$limit = $q['limit_string'];
		}

		$query =
		"
			SELECT
				*
			FROM discount
			$q[where]
			$q[order]
			$limit
		";

		$result = \dash\db::get($query);


		return $result;

	}
}
?>