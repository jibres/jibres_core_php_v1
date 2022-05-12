<?php
namespace lib\db\products\report;


class get
{
	public static function sale_in_date($_date)
	{
		$pagination_query  =
		"
			SELECT
				COUNT(*) AS `count`
			FROM
				factordetails
			JOIN factors ON factors.id = factordetails.factor_id
			WHERE
				factors.date = :date
			GROUP by
				factors.date
		";


		$param =
		[
			':date' => $_date
		];

		$limit = \dash\db\pagination::pagination_query($pagination_query, $param, 50);


		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				SUM(factordetails.price) AS `price`,
				SUM(factordetails.discount) AS `discount`,
				SUM(factordetails.vat) AS `vat`,
				SUM(factordetails.finalprice) AS `finalprice`,
				SUM(factordetails.count) AS `count`,
				SUM(factordetails.sum) AS `sum`,
				factors.date AS `date`
			FROM
				factordetails
			JOIN factors ON factors.id = factordetails.factor_id
			WHERE
				factors.date = :date
			GROUP by
				factors.date
			$limit
		";

		$result = \dash\pdo::get($query, $param);

		return $result;
	}
}
?>