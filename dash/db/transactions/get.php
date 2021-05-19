<?php
namespace dash\db\transactions;


class get
{

	public static function first_verify_transaction()
	{
		$query = "SELECT * FROM transactions WHERE transactions.verify = 1 ORDER BY transactions.id ASC LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function chart_by_date_fa($_enddate, $_month_list)
	{
		$CASE = [];
		foreach ($_month_list as $month => $date)
		{
			$CASE[] = "WHEN transactions.datecreated >= '$date[0] 00:00:00' AND transactions.datecreated <= '$date[1] 23:59:59' THEN '$month'";
		}

		$CASE = " CASE ". implode(" ", $CASE). "  ELSE '0' END ";


		$query  =
		"
			SELECT
				SUM(transactions.plus) AS `sum_plus`,
				SUM(transactions.minus) AS `sum_minus`,
				$CASE AS `month`
			FROM
				transactions
			WHERE
				transactions.verify = 1 AND
				transactions.datecreated >= '$_enddate'
			GROUP BY `month`
		";

		$result = \dash\db::get($query);

		return $result;
	}



	public static function chart_by_date_en($_enddate)
	{
		$query  =
		"
			SELECT
				SUM(transactions.plus) AS `sum_plus`,
				SUM(transactions.minus) AS `sum_minus`,
				CONCAT(YEAR(transactions.datecreated), '-', MONTH(transactions.datecreated)) AS `month`
			FROM
				transactions
			WHERE
				transactions.verify = 1 AND
				transactions.datecreated >= '$_enddate'
			GROUP BY `month`
		";

		$result = \dash\db::get($query);

		return $result;
	}

	public static function count_awating_transaction_per_user($_user_id, $_start_date)
	{
		$query = "SELECT COUNT(*) AS `count` FROM transactions WHERE transactions.datecreated >= '$_start_date' AND (transactions.verify IS NULL OR transactions.verify = 0) AND transactions.user_id = $_user_id ";
		$result = \dash\db::get($query, 'count', true);
		return floatval($result);
	}


	public static function count_transaction_per_ip($_ip_id, $_start_date)
	{
		$query = "SELECT COUNT(*) AS `count` FROM transactions WHERE transactions.datecreated >= '$_start_date' AND (transactions.verify IS NULL OR transactions.verify = 0) AND transactions.ip_id = $_ip_id ";
		$result = \dash\db::get($query, 'count', true);
		return floatval($result);
	}


	public static function count_transaction_per_ip_agent($_ip_id, $_agent_id, $_start_date)
	{
		$query = "SELECT COUNT(*) AS `count` FROM transactions WHERE transactions.datecreated >= '$_start_date' AND (transactions.verify IS NULL OR transactions.verify = 0) AND transactions.ip_id = $_ip_id AND transactions.agent_id = $_agent_id ";
		$result = \dash\db::get($query, 'count', true);
		return floatval($result);
	}



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