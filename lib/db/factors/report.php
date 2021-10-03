<?php
namespace lib\db\factors;

class report
{
	public static function sale_report()
	{
		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				SUM(factors.qty) AS `qty`,
				SUM(factors.subprice) AS `subprice`,
				SUM(factors.subtotal) AS `subtotal`,
				SUM(factors.subvat) AS `subvat`,
				SUM(factors.subdiscount) AS `subdiscount`,
				SUM(factors.discount2) AS `discount2`,
				SUM(factors.shipping) AS `shipping`,
				SUM(factors.total) AS `total`,
				SUM(factors.item) AS `item`,
				DATE(factors.date) AS `date`
			FROM
				factors
			WHERE
				factors.status != 'deleted'
			GROUP BY DATE(factors.date)
		";

		$result = \dash\db::get($query);
		return $result;
	}
}
?>