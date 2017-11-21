<?php
namespace lib\db;

class factors
{
	public static function get_print($_id, $_store_id)
	{
		$factor = "SELECT * FROM factors WHERE factors.id = $_id AND factors.store_id = $_store_id LIMIT 1";
		$factor_detail =
		"
			SELECT
				products.*,
				factordetails.price AS `factordetails_price`,
				factordetails.count AS `factordetails_count`,
				factordetails.discount AS `factordetails_discount`,
				factordetails.sum AS `factordetails_sum`
			FROM
				factordetails
			INNER JOIN products ON products.id = factordetails.product_id
			WHERE
				factordetails.factor_id = $_id
		";
		$result                  = [];
		$result['factor']        = \lib\db::get($factor, null, true);
		$result['factor_detail'] = \lib\db::get($factor_detail);

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

		\lib\db::query($query);

		return \lib\db::insert_id();
	}


	/**
	 * update factor
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function update()
	{
		return \lib\db\config::public_update('factors', ...func_get_args());
	}


	public static function search()
	{
		return \lib\db\config::public_search('factors', ...func_get_args());
	}


	/**
	 * get factor detail
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get()
	{
		if($chach = \lib\db\cache::get_cache('factors', func_get_args()))
		{
			return $chach;
		}
		$result = \lib\db\config::public_get('factors', ...func_get_args());
		\lib\db\cache::set_cache('factors', func_get_args(), $result);
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
		return \lib\db::query($query);
	}

}
?>
