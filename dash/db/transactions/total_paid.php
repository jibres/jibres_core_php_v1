<?php
namespace dash\db\transactions;

trait total_paid
{
	public static function sum_plus()
	{
		$query =
		"
			SELECT
				SUM(transactions.plus) AS `total`
			FROM
				transactions
			WHERE
				transactions.verify = 1
		";
		return \dash\pdo::get($query, [], 'total', true);
	}


	public static function sum_minus()
	{
		$query =
		"
			SELECT
				SUM(transactions.minus) AS `total`
			FROM
				transactions
			WHERE
				transactions.verify = 1
		";
		return \dash\pdo::get($query, [], 'total', true);
	}

}
?>