<?php
namespace lib\db\products\report;


class get
{
	public static function sale_in_date($_date)
	{
		$pagination_query  =
		"

			SELECT
				COUNT(pq.one) AS `count`
			FROM
			(
				SELECT
					1 AS `one`
				FROM
					factordetails
				JOIN factors ON factors.id = factordetails.factor_id
				JOIN products ON products.id = factordetails.product_id
				WHERE
					factors.date >= :start_date AND
					factors.date <= :end_date
				GROUP by
					factordetails.product_id
			) AS `pq`
		";

		$param =
		[
			':start_date' => $_date. ' 00:00:00',
			':end_date'   => $_date. ' 23:59:59',
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
				SUM(factordetails.count) AS `qty`,
				SUM(factordetails.sum) AS `sum`,
				factordetails.product_id AS `product_id`,
				products.title as `product_title`
			FROM
				factordetails
			JOIN factors ON factors.id = factordetails.factor_id
			JOIN products ON products.id = factordetails.product_id
			WHERE
				factors.date >= :start_date AND
				factors.date <= :end_date
			GROUP by
				factordetails.product_id
			ORDER BY `count` DESC
			$limit
		";

		$result = \dash\pdo::get($query, $param);

		return $result;
	}
}
?>