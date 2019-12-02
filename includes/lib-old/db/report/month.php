<?php
namespace lib\db\report;

class month
{
	public static function monthly($_store_id, $_type, $_sort, $_order)
	{
		$date_now = date("Y-m-d");

		$limit_query =
		"
			SELECT
				COUNT(`mycount`) AS `totla_rows`
			FROM
			(
				SELECT
					1 AS `mycount`
				FROM
					factors
				WHERE
					factors.store_id = $_store_id AND
					factors.type = '$_type'  AND
					DATE(factors.date) <= DATE('$date_now')
				GROUP BY MONTH(factors.date), YEAR(factors.date)
			) AS `mycount`
		";
		$totla_rows = \dash\db::get($limit_query, 'totla_rows', true);

		list($start_limit, $end_limit) = \dash\db\mysql\tools\pagination::pagnation(intval($totla_rows), 12);
		if($start_limit > 0)
		{
			$date_start =  date("Y-m-d", strtotime("-". (string) ($start_limit * 30). " days"));
		}
		else
		{
			$date_start =  $date_now;
		}

		$page = intval(\dash\request::get('page'));

		if($page === 0 || $page < 0)
		{
			$page = 1;
		}

		$date_end = date("Y-m-d", strtotime("-". (string) ($page * 12 * 30 )." days"));

		if($_sort === 'date')
		{
			$_sort = "YEAR(factors.date) $_order , MONTH(factors.date) $_order ";
			$_order = null;
		}
		else
		{
			$_sort = "`$_sort`";
		}

		$query =
		"
			SELECT
				MONTH(factors.date) AS `month`,
				YEAR(factors.date) AS `year`,
				SUM(factors.sum) AS `sum`
			FROM
				factors
			WHERE
				factors.store_id = $_store_id AND
				factors.type = '$_type'  AND
				YEAR(factors.date) <= YEAR('$date_start') AND
				YEAR(factors.date) > YEAR('$date_end')

			GROUP BY MONTH(factors.date), YEAR(factors.date)
			ORDER BY $_sort $_order
		";

		$result = \dash\db::get($query);

		return $result;
	}
}
?>