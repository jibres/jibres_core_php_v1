<?php
namespace dash\db\transactions;


class get
{
	public static function total_paid_user($_user_id)
	{
		$query = "SELECT SUM(transactions.plus) AS `total_paid` FROM transactions WHERE transactions.user_id = $_user_id AND transactions.verify = 1 ";
		$result = \dash\db::get($query, 'total_paid', true);
		return $result;
	}

	public static function by_id($_id)
	{
		$query = "SELECT * FROM transactions WHERE transactions.id = $_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function last_payment_user($_user_id)
	{
		$query = "SELECT transactions.plus FROM transactions WHERE transactions.user_id = $_user_id AND transactions.verify = 1 AND transactions.plus IS NOT NULL ORDER BY transactions.id DESC LIMIT 1";
		$result = \dash\db::get($query, 'plus', true);
		return $result;
	}



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