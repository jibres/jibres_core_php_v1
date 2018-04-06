<?php
namespace lib\db;

class products
{

	use \lib\db\product\search;
	use \lib\db\product\dashboard;


	public static function check_multi_product_id($_multi_id, $_store_id)
	{
		$ids = implode(',', $_multi_id);
		$field = self::$public_show_field;
		$query = "SELECT $field FROM products WHERE products.store_id = $_store_id AND products.id IN ($ids) ";
		return \lib\db::get($query);
	}


	/**
	 * insert new product
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
				$set[] = "products.$key = '$value' ";
			}
		}

		if(empty($set))
		{
			return null;
		}

		$set = implode(',', $set);

		$query = "INSERT INTO products SET $set";

		\lib\db::query($query);

		return \lib\db::insert_id();
	}


	/**
	 * update product
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function update()
	{
		return \dash\db\config::public_update('products', ...func_get_args());
	}


	/**
	 * get product detail
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get()
	{
		if($chach = \dash\db\cache::get_cache('products', func_get_args()))
		{
			return $chach;
		}
		$result = \dash\db\config::public_get('products', ...func_get_args());
		\dash\db\cache::set_cache('products', func_get_args(), $result);
		return $result;
	}


	/**
	 * delete one product by id
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

		$query = "DELETE FROM products WHERE id = $_id LIMIT 1";
		return \lib\db::query($query);
	}


	/**
	 * Gets the barcode.
	 *
	 * @param      <type>   $_barcode  The barcode
	 *
	 * @return     boolean  The barcode.
	 */
	public static function get_barcode($_barcode, $_store_id)
	{
		if(!$_barcode)
		{
			return false;
		}

		if(!$_store_id || !is_numeric($_store_id))
		{
			return false;
		}
		$field = self::$public_show_field;
		$query = "SELECT $field FROM  products WHERE products.store_id = $_store_id AND (products.barcode = '$_barcode' OR products.barcode2 = '$_barcode')";
		return \lib\db::get($query);
	}


	/**
	 * Gets the cat list.
	 *
	 * @param      <type>   $_store_id  The store identifier
	 *
	 * @return     boolean  The cat list.
	 */
	public static function get_cat_list($_store_id)
	{
		if(!$_store_id)
		{
			return false;
		}

		$query = "SELECT products.cat AS `cat` FROM products WHERE products.store_id = $_store_id GROUP BY products.cat ORDER BY COUNT(*) DESC";
		return \lib\db::get($query, 'cat');
	}


	/**
	 * Gets the company list.
	 *
	 * @param      <type>   $_store_id  The store identifier
	 *
	 * @return     boolean  The company list.
	 */
	public static function get_company_list($_store_id)
	{
		if(!$_store_id)
		{
			return false;
		}

		$query = "SELECT products.company AS `company` FROM products WHERE products.store_id = $_store_id  GROUP BY products.company ORDER BY COUNT(*) DESC";
		return \lib\db::get($query, 'company');
	}


	/**
	 * Gets the unit list.
	 *
	 * @param      <type>   $_store_id  The store identifier
	 *
	 * @return     boolean  The unit list.
	 */
	public static function get_unit_list($_store_id)
	{
		if(!$_store_id)
		{
			return false;
		}

		$query = "SELECT products.unit AS `unit` FROM products WHERE products.store_id = $_store_id  GROUP BY products.unit ORDER BY COUNT(*) DESC";
		return \lib\db::get($query, 'unit');
	}


	public static function get_all_product($_store_id)
	{
		if(!$_store_id || !is_numeric($_store_id))
		{
			return false;
		}
		$field = self::$public_show_field;
		$query =
		"
			SELECT
				products.title          AS `title`,
				products.name           AS `name`,
				products.cat            AS `cat`,
				products.slug           AS `slug`,
				products.company        AS `company`,
				products.shortcode      AS `shortcode`,
				products.unit           AS `unit`,
				products.barcode        AS `barcode`,
				products.barcode2       AS `barcode2`,
				products.code           AS `code`,
				products.buyprice       AS `buyprice`,
				products.price          AS `price`,
				products.discount       AS `discount`,
				products.vat            AS `vat`,
				products.initialbalance AS `initialbalance`,
				products.minstock       AS `minstock`,
				products.maxstock       AS `maxstock`,
				products.status         AS `status`,
				products.sold           AS `sold`,
				products.stock          AS `stock`,
				products.thumb          AS `thumb`,
				products.service        AS `service`,
				products.saleonline     AS `saleonline`,
				products.salestore      AS `salestore`,
				products.carton         AS `carton`,
				products.desc           AS `desc`
			FROM
				products
			WHERE
				products.store_id = $_store_id
		";
		return \lib\db::get($query);

	}


	public static function get_count()
	{
		return \dash\db\config::public_get_count('products', ...func_get_args());
	}
}
?>