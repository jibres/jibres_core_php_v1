<?php
namespace lib\db\products\report;


class get
{
	public static function product_sales_over_time($_args)
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
					SUM(factordetails.price * factordetails.count) AS `price`,
					SUM(factordetails.discount * factordetails.count) AS `discount`,
					SUM(factordetails.vat * factordetails.count) AS `vat`,
					SUM(factordetails.finalprice * factordetails.count) AS `finalprice`,
					SUM(factordetails.sum) AS `sum`
				FROM
					factordetails
				JOIN factors ON factors.id = factordetails.factor_id
				JOIN products ON products.id = factordetails.product_id
				WHERE
					factors.status != 'deleted' AND
					factors.type  IN ('sale', 'saleorder') AND
					factors.date >= :startdate AND
					factors.date <= :enddate

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

		$calculate_total =
		"
			SELECT
				SUM(factors.total) AS `factortotal`,
				SUM(factors.shipping) AS `shipping`
			FROM
				factors
			WHERE
				factors.status != 'deleted' AND
				factors.type  IN ('sale', 'saleorder') AND
				factors.date >= :startdate AND
				factors.date <= :enddate
		";

		$calculate_total = \dash\pdo::get($calculate_total, $param, null, true);

		if(is_array($calculate_total))
		{
			$total_result = array_merge($total_result, $calculate_total);
		}

		$total_result['total'] = floatval(a($total_result, 'sum')) + floatval(a($total_result, 'shipping'));

		$limit = \dash\db\pagination::get_limit($total_rows, 50);


		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				SUM(factordetails.price * factordetails.count) AS `price`,
				SUM(factordetails.discount * factordetails.count) AS `discount`,
				SUM(factordetails.vat * factordetails.count) AS `vat`,
				SUM(factordetails.finalprice * factordetails.count) AS `finalprice`,
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
				factors.date <= :enddate

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


	/**
	 * Report sales over time
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	public static function sales_over_time($_args)
	{
		$pagination_query  =
		"

			SELECT
				COUNT(pq.one) AS `count`,
				SUM(pq.price) AS `price`,
				SUM(pq.discount) AS `discount`,
				SUM(pq.vat) AS `vat`,
				SUM(pq.sum) AS `sum`
			FROM
			(
				SELECT
					DATE(factors.date) AS `order_date`,
					1 AS `one`,
					SUM(factors.subprice) AS `price`,
					SUM(factors.subdiscount) AS `discount`,
					SUM(factors.subvat) AS `vat`,
					SUM(factors.qty) AS `qty`,
					SUM(factors.total) AS `sum`
				FROM
					factors
				WHERE
					factors.status != 'deleted' AND
					factors.type  IN ('sale', 'saleorder') AND
					factors.date >= :startdate AND
					factors.date <= :enddate
				GROUP by
					`order_date`
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
				DATE(factors.date) AS `order_date`,
				COUNT(*) AS `count`,
				SUM(factors.subprice) AS `price`,
				SUM(factors.subdiscount) AS `discount`,
				SUM(factors.subvat) AS `vat`,
				SUM(factors.qty) AS `qty`,
				SUM(factors.total) AS `sum`

			FROM
				factors
			WHERE
				factors.status != 'deleted' AND
				factors.type  IN ('sale', 'saleorder') AND
				factors.date >= :startdate AND
				factors.date <= :enddate
			GROUP by
				`order_date`
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