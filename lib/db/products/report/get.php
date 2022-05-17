<?php
namespace lib\db\products\report;


class get
{
	public static function sale_in_date($_args)
	{
		$pagination_query  =
		"

			SELECT
				COUNT(pq.one) AS `count`,
				SUM(pq.countorder) AS `countorder`,
				SUM(pq.price) AS `price`,
				SUM(pq.discount) AS `discount`,
				SUM(pq.vat) AS `vat`,
				SUM(pq.finalprice) AS `finalprice`,
				SUM(pq.sum) AS `sum`
			FROM
			(
				SELECT
					1 AS `one`,
					COUNT(*) AS `countorder`,
					SUM(factordetails.price) AS `price`,
					SUM(factordetails.discount) AS `discount`,
					SUM(factordetails.vat) AS `vat`,
					SUM(factordetails.finalprice) AS `finalprice`,
					SUM(factordetails.sum) AS `sum`
				FROM
					factordetails
				JOIN factors ON factors.id = factordetails.factor_id
				JOIN products ON products.id = factordetails.product_id
				WHERE
					factors.status != 'deleted' AND
					factors.type  IN ('sale', 'saleorder') AND
					factors.date >= :startdate AND
					factors.date <= :enddate AND
					factordetails.count > 0
				GROUP by
					factordetails.product_id
			) AS `pq`
		";

		$param =
		[
			':startdate' => $_args['startdate'],
			':enddate'   => $_args['enddate'],
		];

		$total_result = \dash\pdo::get($pagination_query, $param, null, true);

		$total_rows = 0;
		if(isset($total_result['count']))
		{
			$total_rows = $total_result['count'];
		}

		$limit = \dash\db\pagination::get_limit($total_rows, 50);


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
				products.title as `product_title`,
				productunit.title as `product_unit`
			FROM
				factordetails
			JOIN factors ON factors.id = factordetails.factor_id
			JOIN products ON products.id = factordetails.product_id
			LEFT JOIN productunit ON productunit.id = products.unit_id
			WHERE
				factors.status != 'deleted' AND
				factors.type  IN ('sale', 'saleorder') AND
				factors.date >= :startdate AND
				factors.date <= :enddate AND
				factordetails.count > 0
			GROUP by
				factordetails.product_id
			ORDER BY `$_args[sort]` $_args[order]
			$limit
		";

		$result            = [];
		$result['summary'] = $total_result;
		$result['list']    = \dash\pdo::get($query, $param);

		return $result;
	}
}
?>