<?php
namespace lib\db\report;

class daily
{
	public static function last_30_days($_store_id, $_type)
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
				GROUP BY DATE(factors.date)
			) AS `mycount`
		";
		$totla_rows = \dash\db::get($limit_query, 'totla_rows', true);

		list($start_limit, $end_limit) = \dash\db::pagnation(intval($totla_rows), 30);
		if($start_limit > 0)
		{
			$date_start =  date("Y-m-d", strtotime("-$start_limit days"));
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

		$date_end = date("Y-m-d", strtotime("-". (string) ($page * 30)." days"));

		$query =
		"
			SELECT
				DATE(factors.date) AS `date`,
				SUM(factors.sum) AS `sum`
			FROM
				factors
			WHERE
				factors.store_id = $_store_id AND
				factors.type = '$_type'  AND
				(
					DATE(factors.date) <= DATE('$date_start') AND
					DATE(factors.date) > DATE('$date_end')

				)
			GROUP BY DATE(factors.date)
		";

		$result = \dash\db::get($query, ['date', 'sum']);
		return $result;
	}
}
?>