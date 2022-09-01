<?php
namespace lib\db\store;


class get
{

	public static function count_group_by_month()
	{
		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				CONCAT(YEAR(store.datecreated), '-', MONTH(store.datecreated)) AS `year_month`
			FROM
				store
			GROUP by
				`year_month`
		";

		$result = \dash\pdo::get($query, [], null, false, 'master');

		return $result;
	}


	public static function count_group_by_year()
	{
		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				YEAR(store.datecreated) AS `year`
			FROM
				store
			GROUP by
				`year`
		";

		$result = \dash\pdo::get($query, [], null, false, 'master');

		return $result;
	}


	public static function all_store_group_by_datecreated()
	{
		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				DATE(store.datecreated) AS `myDate`
			FROM
				store
			GROUP by
				`myDate`
			ORDER BY myDate ASC
		";

		$result = \dash\pdo::get($query, [], null, false, 'master');

		return $result;
	}


	public static function reserved_business()
	{
		$query  = "SELECT store.id AS `id` FROM store WHERE store.status = 'awaiting' AND store.creator IS NULL AND store.subdomain IS NULL ORDER BY store.id ASC LIMIT 1 FOR UPDATE";
		$result = \dash\pdo::get($query, [], 'id', true, 'master');
		return $result;
	}

	public static function count_reserved_business()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM store WHERE store.status = 'awaiting' AND store.creator IS NULL AND store.subdomain IS NULL ";
		$result = \dash\pdo::get($query, [], 'count', true, 'master');
		return $result;
	}



	public static function owner($_store_id)
	{
		$query  = "SELECT store_data.owner AS `owner` FROM store_data  WHERE store_data.id = :id LIMIT 1";
		$param  = [':id' => $_store_id];
		$result = \dash\pdo::get($query, $param, 'owner', true);
		return $result;
	}


	public static function user_first_product($_user_id)
	{
		$query =
		"
			SELECT
				SUM(store_analytics.product) AS `sum`
			FROM
				store_analytics
			INNER JOIN store_data ON store_data.id = store_analytics.id
			WHERE
				store_data.owner = $_user_id
		";
		$result = \dash\pdo::get($query, [], 'sum', true, 'master');

		return $result;
	}


	public static function user_first_order($_user_id)
	{
		$query =
		"
			SELECT
				SUM(store_analytics.factor) AS `sum`
			FROM
				store_analytics
			INNER JOIN store_data ON store_data.id = store_analytics.id
			WHERE
				store_data.owner = $_user_id
		";
		$result = \dash\pdo::get($query, [], 'sum', true, 'master');

		return $result;
	}


	public static function count_store_analytics_product()
	{
		$query = "SELECT SUM(store_analytics.product) AS `product` FROM store_analytics ";
		$result = \dash\pdo::get($query, [], 'product', true);
		return floatval($result);
	}


	public static function count_store_analytics_factor()
	{
		$query = "SELECT SUM(store_analytics.factor) AS `factor` FROM store_analytics ";
		$result = \dash\pdo::get($query, [], 'factor', true);
		return floatval($result);
	}


	public static function sum_store_analytics_factor()
	{
		$query = "SELECT SUM(store_analytics.sumfactor) AS `sumfactor` FROM store_analytics WHERE (store_analytics.sumfactor / store_analytics.factor) < 50000000 ";
		$result = \dash\pdo::get($query, [], 'sumfactor', true);
		return floatval($result);
	}



	public static function all_store_fuel_detail()
	{
		$query =
		"
			SELECT
				store.id,
				store.fuel,
				store.subdomain
			FROM
				store
			INNER JOIN store_data ON store_data.id = store.id
			ORDER BY store.id ASC
		";
		$result = \dash\pdo::get($query, [], null, false, 'master');
		return $result;
	}


	public static function all_version_detail()
	{
		$query =
		"
			SELECT
				store.id,
				store.fuel,
				store.subdomain,
				store.dbversion,
				store.dbversiondate
			FROM
				store
		";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function all_version()
	{
		$query = "SELECT dbversion FROM store ";
		$result = \dash\pdo::get($query, [], 'dbversion');
		return $result;
	}

	public static function subdomain_exist($_subdomain)
	{
		$query = "SELECT * FROM store WHERE store.subdomain = '$_subdomain' LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true, 'master');
		return $result;
	}

	public static function detail($_store_id)
	{
		$query = "SELECT * FROM store WHERE store.id = $_store_id LIMIT 1 ";
		$result = \dash\pdo::get($query, [], null, true, 'master');
		return $result;
	}

	public static function get_by_subdomain_user_id($_subdomain, $_owner)
	{
		$query =
		"
			SELECT
				*
			FROM
				store
			INNER JOIN store_data ON store_data.id = store.id
			WHERE
				store.subdomain = :subdomain AND
				store_data.owner = :owner
			 LIMIT 1
		";

		$param =
		[
			':subdomain' => $_subdomain,
			':owner'     => $_owner,
		];

		$result = \dash\pdo::get($query, $param, null, true, 'master');
		return $result;
	}


	public static function data($_store_id)
	{
		$query = "SELECT * FROM store_data WHERE store_data.id = $_store_id LIMIT 1 ";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function count_free_trial($_user_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM store WHERE store.creator = $_user_id ";
		$result = \dash\pdo::get($query, [], 'count', true, 'master');
		return $result;
	}


	public static function subdomain($_subdomain)
	{
		$query = "SELECT * FROM store WHERE store.subdomain = '$_subdomain' LIMIT 1 ";
		$result = \dash\pdo::get($query, [], null, true, 'master');
		return $result;
	}


	public static function subdomain_detail($_subdomain)
	{
		$query = "SELECT * FROM store WHERE store.subdomain = '$_subdomain' LIMIT 1 ";
		$result = \dash\pdo::get($query, [], null, true, 'master');
		return $result;
	}

	public static function by_id($_id)
	{
		$query = "SELECT * FROM store WHERE store.id = $_id LIMIT 1 ";
		$result = \dash\pdo::get($query, [], null, true, 'master');
		return $result;
	}
}
?>