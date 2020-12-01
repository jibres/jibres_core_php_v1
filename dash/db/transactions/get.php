<?php
namespace dash\db\transactions;


class get
{

	public static function first_pay_user($_user_id)
	{
		$query = "SELECT * FROM transactions WHERE transactions.user_id = $_user_id AND transactions.verify = 1 LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function success_percent($_date = null)
	{
		$date = null;

		if($_date)
		{
			$date = " WHERE DATE(transactions.datecreated) >= DATE('$_date') ";
		}

		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				transactions.verify
			FROM
				transactions
			$date
			GROUP BY
				transactions.verify
		";

		$result = \dash\db::get($query);
		return $result;

	}


	public static function chart_stack_date($_end_date)
	{
		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				DATE(transactions.datecreated) AS `datecreated`,
				transactions.verify
			FROM
				transactions
			WHERE
				DATE(transactions.datecreated) >= DATE('$_end_date')
			GROUP BY
				DATE(transactions.datecreated), transactions.verify
		";

		$result = \dash\db::get($query);
		return $result;
	}
}
?>