<?php
namespace lib\db\store;


class get
{




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
		$result = \dash\db::get($query, 'sum', true, 'master');

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
		$result = \dash\db::get($query, 'sum', true, 'master');

		return $result;
	}


	public static function count_store_analytics_product()
	{
		$query = "SELECT SUM(store_analytics.product) AS `product` FROM store_analytics ";
		$result = \dash\db::get($query, 'product', true);
		return intval($result);
	}


	public static function count_store_analytics_factor()
	{
		$query = "SELECT SUM(store_analytics.factor) AS `factor` FROM store_analytics ";
		$result = \dash\db::get($query, 'factor', true);
		return intval($result);
	}


	public static function sum_store_analytics_factor()
	{
		$query = "SELECT SUM(store_analytics.sumfactor) AS `sumfactor` FROM store_analytics ";
		$result = \dash\db::get($query, 'sumfactor', true);
		return intval($result);
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
		";
		$result = \dash\db::get($query, null, false, 'master');
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
				store_data.dbversion,
				store_data.dbversiondate
			FROM
				store
			INNER JOIN store_data ON store_data.id = store.id
		";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function all_version()
	{
		$query = "SELECT dbversion FROM store_data";
		$result = \dash\db::get($query, 'dbversion');
		return $result;
	}

	public static function subdomain_exist($_subdomain)
	{
		$query = "SELECT * FROM store WHERE store.subdomain = '$_subdomain' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}

	public static function detail($_store_id)
	{
		$query = "SELECT * FROM store WHERE store.id = $_store_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}


	public static function data($_store_id)
	{
		$query = "SELECT * FROM store_data WHERE store_data.id = $_store_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function count_free_trial($_user_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM store_data WHERE store_data.owner = $_user_id AND store_data.plan IN ('free', 'trial') ";
		$result = \dash\db::get($query, 'count', true, 'master');
		return $result;
	}


	public static function subdomain($_subdomain)
	{
		$query = "SELECT * FROM store WHERE store.subdomain = '$_subdomain' LIMIT 1 ";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}


	public static function subdomain_detail($_subdomain)
	{
		$query = "SELECT * FROM store WHERE store.subdomain = '$_subdomain' LIMIT 1 ";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}

	public static function by_id($_id)
	{
		$query = "SELECT * FROM store WHERE store.id = $_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}
}
?>