<?php
namespace dash\db\transactions;

class search
{
	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM transactions LEFT JOIN users ON users.id = transactions.user_id $q[where]  ";

		$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);

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

		$result = \dash\db::get($query);

		return $result;
	}


	public static function list_sum($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);


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
			$q[where]
		";

		$result = \dash\db::get($query, null, true);

		return $result;
	}



}
?>