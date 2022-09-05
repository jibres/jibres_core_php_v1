<?php
namespace lib\db\factors;

class search
{

	public static function list_join_factordetails($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\pdo\prepare_query::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =
		"
			SELECT COUNT(*) AS `count` FROM factors
			LEFT JOIN factordetails ON factors.id = factordetails.factor_id
			LEFT JOIN users ON users.id = factors.customer
			$q[where]
		";

		$limit = \dash\db\pagination::pagination_query($pagination_query, []);

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

		$result = \dash\pdo::get($query);

		return $result;

	}


	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\pdo\prepare_query::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM factors $q[where] ";

		$limit = \dash\db\pagination::pagination_query($pagination_query);

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

		$result = \dash\pdo::get($query);

		return $result;
	}


	public static function auto_expire_order($_expire_date)
	{
		$query =
		"
			SELECT
				factors.*
			FROM
				factors
			WHERE
				factors.status = 'registered' AND
				factors.type = 'saleorder' AND
				factors.paystatus = 'awaiting_payment'  AND
				factors.datecreated <= '$_expire_date'
			";

		$result = \dash\pdo::get($query);

		return $result;
	}
}
?>