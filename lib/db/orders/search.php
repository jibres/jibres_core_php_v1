<?php
namespace lib\db\orders;

class search
{
	public static function list_join_by_factordetails($_param, $_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\pdo\prepare_query::ready_pdo_query_args($_and, $_or, $_order_sort, $_meta);

		$pagination_query =
		"
			SELECT COUNT(*) AS `count` FROM factors
			LEFT JOIN factordetails ON factors.id = factordetails.factor_id
			LEFT JOIN users ON users.id = factors.customer
			$q[where]
		";

		$limit = \dash\db\pagination::pagination_query_pdo($pagination_query, $_param);

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

		$result = \dash\pdo::get($query, $_param);

		return $result;

	}


	public static function list($_param, $_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\pdo\prepare_query::ready_pdo_query_args($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM factors $q[where] ";

		$limit = \dash\db\pagination::pagination_query_pdo($pagination_query, $_param);

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

		$result = \dash\pdo::get($query, $_param);

		return $result;
	}


}
?>