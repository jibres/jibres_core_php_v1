<?php
namespace lib\db;

class factors
{

	use \lib\db\factor\search;

	public static function product_last_factor_date($_product_id, $_type)
	{
		if(!$_product_id || !is_numeric($_product_id))
		{
			return false;
		}

		$query =
		"
			SELECT
				factors.datecreated AS `datecreated`
			FROM
				factors
			INNER JOIN factordetails ON factordetails.factor_id = factors.id
			WHERE
				factordetails.product_id = $_product_id 	AND
				factors.type             = '$_type' 		AND
				factors.pre IS NULL
			ORDER BY factors.id DESC
			LIMIT 1
		";

		$result = \dash\db::get($query, 'datecreated', true);

		return $result ? $result : null;

	}

	public static function get_count_group_by($_store_id)
	{
		if(!$_store_id || !is_numeric($_store_id))
		{
			return false;
		}

		$query = "SELECT COUNT(*) AS `count`, factors.type AS `type` FROM factors WHERE factors.store_id = '$_store_id' GROUP BY factors.type ";

		return \dash\db::get($query, ['type', 'count']);
	}



	public static function time_chart($_store_id, $_type)
	{
		if(!$_store_id || !is_numeric($_store_id) || !$_type)
		{
			return false;
		}

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
				factors.store_id = $_store_id AND
				DATE(factors.date) > DATE('$date') AND
				DATE(factors.date) != DATE('$date_now')

			GROUP BY `key`
			ORDER BY `key` ASC

		";
		$result = \dash\db::get($query);

		return $result;
	}

	public static function get_print($_id, $_store_id)
	{
		$factor =
		"
			SELECT
				factors.*,
				userstores.firstname AS `customer_firstname`,
				userstores.phone AS `customer_phone`,
				userstores.displayname AS `customer_displayname`,
				userstores.lastname AS `customer_lastname`,
				userstores.mobile AS `customer_mobile`,
				userstores.gender AS `customer_gender`
			FROM
				factors
			LEFT JOIN userstores ON userstores.id = factors.customer
			WHERE
				factors.id       = $_id AND
				factors.store_id = $_store_id
			LIMIT 1
		";
		$factor_detail =
		"
			SELECT
				products.*,
				factordetails.price    AS `factordetails_price`,
				factordetails.count    AS `factordetails_count`,
				factordetails.discount AS `factordetails_discount`,
				factordetails.sum      AS `factordetails_sum`
			FROM
				factordetails
			INNER JOIN products ON products.id = factordetails.product_id
			WHERE
				factordetails.factor_id = $_id
		";
		$result                  = [];
		$result['factor']        = \dash\db::get($factor, null, true);
		$result['factor_detail'] = \dash\db::get($factor_detail);

		return $result;
	}

	/**
	 * insert new factor
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function insert($_args)
	{
		$set = [];
		foreach ($_args as $key => $value)
		{
			if($value)
			{
				$set[] = "factors.$key = '$value' ";
			}
		}

		if(empty($set))
		{
			return null;
		}

		$set = implode(',', $set);

		$query = "INSERT INTO factors SET $set";

		\dash\db::query($query);

		return \dash\db::insert_id();
	}


	/**
	 * update factor
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function update()
	{
		return \dash\db\config::public_update('factors', ...func_get_args());
	}


	/**
	 * get factor detail
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get()
	{
		if($chach = \dash\db\cache::get_cache('factors', func_get_args()))
		{
			return $chach;
		}
		$result = \dash\db\config::public_get('factors', ...func_get_args());
		\dash\db\cache::set_cache('factors', func_get_args(), $result);
		return $result;
	}


	/**
	 * delete one factor by id
	 *
	 * @param      <type>   $_id    The identifier
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function delete($_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			return false;
		}

		$query = "DELETE FROM factors WHERE id = $_id LIMIT 1";
		return \dash\db::query($query);
	}


	public static function get_count()
	{
		return \dash\db\config::public_get_count('factors', ...func_get_args());
	}

	public static function sum_all()
	{
		$query = "SELECT SUM(factors.sum) AS `sum` FROM factors WHERE type = 'sale' AND factors.sum < 10000000 ";
		return \dash\db::get($query, 'sum', true);
	}

}
?>
