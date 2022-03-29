<?php
namespace lib\db\factors;

class chart
{
	public static function time_chart($_type)
	{
		$date     = date("Y-m-d H:i:s", strtotime("-30 day"));
		$date_now = date("Y-m-d 00:00:00");
		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				SUM(factors.total) AS `sum`,
				hour(factors.date) AS `key`
			FROM
				factors
			WHERE
				factors.date >= :start_date
			GROUP BY `key`
			ORDER BY `key` ASC

		";

		$param =
		[
			':start_date' => $date,
		];

		$result = \dash\pdo::get($query, $param);
		return $result;
	}
}
?>
