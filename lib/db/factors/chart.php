<?php
namespace lib\db\factors;

class chart
{
	public static function time_chart($_type)
	{
		$date     = date("Y-m-d", strtotime("-30 day"));
		$date_now = date("Y-m-d");
		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				SUM(factors.sum) AS `sum`,
				hour(factors.date) AS `key`
			FROM
				factors
			WHERE
				DATE(factors.date) > DATE('$date') AND
				DATE(factors.date) != DATE('$date_now')

			GROUP BY `key`
			ORDER BY `key` ASC

		";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>
