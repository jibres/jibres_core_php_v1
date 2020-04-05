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
			$_and = implode(' AND ', $_and);
			$q[] = "$_and";

		}

		if($_or)
		{
			$_or = implode(' OR ', $_or);
			$q[] = "($_or)";
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

		$pagination = null;
		if(array_key_exists('pagination', $_meta))
		{
			$pagination = $_meta['pagination'];
		}

		$limit = null;
		if(array_key_exists('limit', $_meta))
		{
			$limit = $_meta['limit'];
		}

		return
		[
			'where'      => $where,
			'order'      => $order,
			'pagination' => $pagination,
			'limit'      => $limit,
		];
	}



	public static function list_join_factordetails($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = self::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =
		"
			SELECT COUNT(*) AS `count` FROM factors
			LEFT JOIN factordetails ON factors.id = factordetails.factor_id
			LEFT JOIN users ON users.id = factors.customer
			$q[where]
		";

		$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query);

		$query =
		"
			SELECT
				factors.*,
				users.displayname,
				users.firstname,
				users.lastname,
				users.gender,
				users.mobile,
				users.avatar
			FROM factors
			LEFT JOIN factordetails ON factors.id = factordetails.factor_id
			LEFT JOIN users ON users.id = factors.customer
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

		$query =
		"
			SELECT
				factors.*,
				users.displayname,
				users.firstname,
				users.lastname,
				users.gender,
				users.mobile,
				users.avatar
			FROM
				factors
			LEFT JOIN users ON users.id = factors.customer
			$q[where] $q[order] $limit ";

		$result = \dash\db::get($query);

		return $result;
	}
}
?>