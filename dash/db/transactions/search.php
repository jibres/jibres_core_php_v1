<?php
namespace dash\db\transactions;

class search
{
	public static function list($_param, $_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\pdo\prepare_query::binded_ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM transactions LEFT JOIN users ON users.id = transactions.user_id $q[where]  ";

		$limit = \dash\db\pagination::pagination_query($pagination_query, $_param, $q['limit']);

		$query =
		"
			SELECT
				transactions.*,
				users.mobile      AS `mobile`,
				users.displayname AS `displayname`,
				users.avatar AS `avatar`
			FROM
				transactions
			LEFT JOIN users ON users.id = transactions.user_id
			$q[where] $q[order] $limit ";

		$result = \dash\pdo::get($query, $_param);

		return $result;
	}


	public static function list_sum($_param, $_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\pdo\prepare_query::binded_ready_to_sql($_and, $_or, $_order_sort, $_meta);


		$query =
		"
			SELECT
				SUM(IFNULL(transactions.plus, 0)) AS `sum_plus`,
				AVG(IFNULL(transactions.plus, 0)) AS `avg_plus`,
				SUM(IF(transactions.plus > 0, 1, 0)) AS `count_plus`,
				SUM(IFNULL(transactions.minus, 0)) AS `sum_minus`,
				AVG(IFNULL(transactions.minus, 0)) AS `avg_minus`,
				SUM(IF(transactions.minus > 0, 1, 0)) AS `count_minus`
			FROM
				transactions
			LEFT JOIN users ON users.id = transactions.user_id

			$q[where]
		";

		$result = \dash\pdo::get($query, $_param, null, true);

		return $result;
	}



}
?>