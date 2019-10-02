<?php
namespace lib\db\products2;

class db
{

	// @check @javad
	// need to check in not deleted product?
	public static function get_barcode($_barcode, $_store_id)
	{
		$query =
		"
			SELECT
				`id`,
				`title`,
				`barcode`,
				`barcode2`
			FROM
			 	products2
			WHERE
				products2.store_id = $_store_id AND
				products2.status  != 'deleted' AND
				(products2.barcode = '$_barcode' OR products2.barcode2 = '$_barcode')
		";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function insert($_args, $_store_id)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query =
			"
				INSERT INTO `products2`
				SET $set,
				products2.code = (SELECT IFNULL(MAX(myProd.code), 0) FROM products2 AS `myProd` WHERE myProd.store_id = $_store_id ) + 1
			";

			if(\dash\db::query($query))
			{
				$id = \dash\db::insert_id();
				return $id;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}


	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'update']);
		if($set)
		{
			$query = " UPDATE `products2` SET $set WHERE products2.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
		else
		{
			return false;
		}
	}


	public static function get_one_field($_id, $_field)
	{
		$query  = "SELECT products2.$_field FROM products2 WHERE products2.id = $_id  LIMIT 1";
		$result = \dash\db::get($query, $_field, true);
		return $result;
	}


	public static function get_by_id($_id, $_store_id)
	{
		$query  = "SELECT * FROM products2 WHERE products2.id = $_id AND products2.store_id = $_store_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function get_by_code($_code, $_store_id)
	{
		$query  = "SELECT * FROM products2 WHERE products2.store_id = $_store_id AND products2.code = $_code  LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
















	public static function get_one($_store_id, $_id)
	{
		$query  = "SELECT * FROM products WHERE products.id = $_id AND products.store_id = $_store_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function field_group_count($_field, $_store_id)
	{
		$catch = \dash\db\cache::get_cache('products', func_get_args());
		if($catch)
		{
			return $catch;
		}

		if(!$_store_id || !is_numeric($_store_id))
		{
			return false;
		}

		$query = "SELECT COUNT(*) AS `count`, products.$_field AS `$_field` FROM products WHERE products.store_id = $_store_id GROUP BY products.$_field ORDER BY count(*) DESC";
		$result = \dash\db::get($query, [$_field, 'count']);
		\dash\db\cache::set_cache('products', func_get_args(), $result);
		return $result;
	}



	public static function get_duplicate_id($_store_id)
	{
		if(!$_store_id || !is_numeric($_store_id))
		{
			return false;
		}

		$query =
		"
			SELECT
				products.id
			FROM
				products
			INNER JOIN
				(
					SELECT
						title
					FROM
						products
					WHERE
						products.store_id = $_store_id
					GROUP BY title
					HAVING COUNT(*) > 1
				) dup
			   ON products.title = dup.title
		";
		$result = \dash\db::get($query, 'id');

		return $result;
	}

	public static function check_multi_product_id($_multi_id, $_store_id)
	{
		$ids = implode(',', $_multi_id);
		$field = self::$public_show_field;
		$query = "SELECT $field FROM products WHERE products.store_id = $_store_id AND products.id IN ($ids) ";
		return \dash\db::get($query);
	}


	/**
	 * insert new product
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */



	public static function multi_insert($_args)
	{
		$result = \dash\db\config::public_multi_insert('products', ...func_get_args());
		return $result;
	}


	/**
	 * update product
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */


	public static function update_where()
	{
		return \dash\db\config::public_update_where('products', ...func_get_args());
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
		return \dash\db::query($query);
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
		return \dash\db::get($query, 'cat');
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
		return \dash\db::get($query, 'company');
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
		return \dash\db::get($query, 'unit');
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
				products.cat            AS `cat`,
				products.slug           AS `slug`,
				products.company        AS `company`,
				products.shortcode      AS `shortcode`,
				products.unit           AS `unit`,
				products.barcode        AS `barcode`,
				products.barcode2       AS `barcode2`,
				products.quickcode           AS `quickcode`,
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
		return \dash\db::get($query);

	}


	public static function get_count()
	{
		return \dash\db\config::public_get_count('products', ...func_get_args());
	}
}
?>