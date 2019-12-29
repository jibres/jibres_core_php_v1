<?php
namespace lib\db\factors;

class search
{
	private static function ready_to_sql($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$where = null;
		$q     = [];

		if($_and)
		{
			$q[] = \dash\db\config::make_where($_and, ['condition' => 'AND']);
		}

		if($_or)
		{
			$or =  \dash\db\config::make_where($_or, ['condition' => 'OR']);
			$q[] = "($or)";
		}

		if($q)
		{
			$where = 'WHERE '. implode(" AND ", $q);
		}

		$order = null;
		if($_order_sort && is_string($_order_sort))
		{
			$order = $_order_sort;
		}

		return
		[
			'where' => $where,
			'order' => $order,
		];
	}



	public static function list_join_factordetails($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = self::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =
		"
			SELECT COUNT(*) AS `count` FROM factors
			LEFT JOIN factordetails ON factors.id = factordetails.factor_id
			$q[where]
		";

		$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query);

		$query =
		"
			SELECT
				factors.*
			FROM factors
			LEFT JOIN factordetails ON factors.id = factordetails.factor_id
			$q[where] $q[order] $limit
		";

		$result = \dash\db::get($query);

		return $result;

	}


	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = self::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM factors $q[where] ";

		$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query);

		$query = "SELECT factors.* FROM factors $q[where] $q[order] $limit ";

		$result = \dash\db::get($query);

		return $result;
	}
}
?>