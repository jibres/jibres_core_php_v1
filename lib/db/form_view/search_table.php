<?php
namespace lib\db\form_view;


class search_table
{

	public static function get_count_all($_table)
	{
		$query = "SELECT COUNT(*) AS `count`	FROM `$_table` ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function get_count_where($_table, $_where)
	{
		$where = implode(' AND ', $_where);
		$query = "SELECT COUNT(*) AS `count`	FROM `$_table` WHERE $where ";
		$result = \dash\db::get($query, 'count', true);
		if(!is_numeric($result))
		{
			return 0;
		}
		return floatval($result);
	}





	public static function list($_table, $_and = null, $_or = null, $_order_sort = null, $_meta = [])
	{

		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =	"SELECT COUNT(*) AS `count`	FROM `$_table` $q[join] $q[where] ";

		$limit = null;

		if($q['start_limit'] && $q['limit'])
		{
			$limit = " LIMIT $q[start_limit], $q[limit] ";
		}
		else
		{
			if($q['pagination'] !== false)
			{
				$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
			}
		}

		$query =
		"
			SELECT
				`$_table`.*
			FROM `$_table`
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