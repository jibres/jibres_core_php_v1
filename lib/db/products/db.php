<?php
namespace lib\db\products;

class db
{

	public static function get_next_prev($_id)
	{
		$next        = "SELECT products.id AS `id` FROM products where products.id = (SELECT MIN(products.id) FROM products where products.id > $_id) LIMIT 1 ";
		$next_result = \dash\db::get($next, 'id', true);

		$prev        = "SELECT products.id AS `id` FROM products where products.id = (SELECT MAX(products.id) FROM products where products.id < $_id) LIMIT 1 ";
		$prev_result = \dash\db::get($prev, 'id', true);

		return
		[
			'next' => $next_result,
			'prev' => $prev_result
		];
	}



	public static function get_barcode($_barcode)
	{
		$query =
		"
			SELECT
				`id`,
				`title`,
				`barcode`,
				`barcode2`
			FROM
			 	products
			WHERE
				products.status  != 'deleted' AND
				(products.barcode = '$_barcode' OR products.barcode2 = '$_barcode')
		";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function insert($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `products` SET $set ";
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
			$query = " UPDATE `products` SET $set WHERE products.id = $_id LIMIT 1";
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
		$query  = "SELECT products.$_field FROM products WHERE products.id = $_id  LIMIT 1";
		$result = \dash\db::get($query, $_field, true);
		return $result;
	}

	private static function get_product_query_string()
	{
		$query =
		"
				products.*,
				productprices.price,
				productprices.buyprice,
				productprices.discount,
				productprices.discountpercent,
				productprices.finalprice
			FROM
				products
			LEFT JOIN productprices ON productprices.product_id = products.id AND productprices.last = 'yes'
		";

		return $query;
	}



	public static function get_by_id($_id)
	{
		$public_query = self::get_product_query_string();
		$query  =
		"
			SELECT
				$public_query
			WHERE
				products.id = $_id
			LIMIT 1
		";
		$result = \dash\db::get($query, null, true);
		return $result;
	}




	public static function update_thumb($_thumb, $_id)
	{
		if($_thumb)
		{
			$query  = "UPDATE products SET products.thumb = '$_thumb' WHERE products.id = $_id LIMIT 1";
		}
		else

		{
			$query  = "UPDATE products SET products.thumb = NULL WHERE products.id = $_id LIMIT 1";
		}
		$result = \dash\db::query($query);
		return $result;
	}


	public static function update_gallery($_gallery, $_id)
	{
		$query  = "UPDATE products SET products.gallery = '$_gallery' WHERE products.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function check_unique_sku($_sku)
	{
		$query = "SELECT `id`, `sku` FROM products WHERE products.sku = '$_sku' AND products.status  != 'deleted' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function get_one($_id)
	{
		$query  = "SELECT * FROM products WHERE products.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function field_group_count($_field)
	{
		$catch = \dash\db\cache::get_cache('products', func_get_args());
		if($catch)
		{
			return $catch;
		}

		$query = "SELECT COUNT(*) AS `count`, products.$_field AS `$_field` FROM products GROUP BY products.$_field ORDER BY count(*) DESC";
		$result = \dash\db::get($query, [$_field, 'count']);
		\dash\db\cache::set_cache('products', func_get_args(), $result);
		return $result;
	}



	public static function get_duplicate_id()
	{
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
					GROUP BY title
					HAVING COUNT(*) > 1
				) dup
			   ON products.title = dup.title
		";
		$result = \dash\db::get($query, 'id');

		return $result;
	}

	public static function check_multi_product_id($_multi_id)
	{
		$ids = implode(',', $_multi_id);
		$field = self::$public_show_field;
		$query = "SELECT $field FROM products WHERE products.id IN ($ids) ";
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


	public static function update_status($_status, $_id)
	{
		$query  = "UPDATE products SET products.status = '$_status' WHERE products.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}



	/**
	 * Gets the cat list.
	 *
	 *
	 * @return     boolean  The cat list.
	 */
	public static function get_cat_list()
	{
		$query = "SELECT products.cat AS `cat` FROM products GROUP BY products.cat ORDER BY COUNT(*) DESC";
		return \dash\db::get($query, 'cat');
	}


	/**
	 * Gets the company list.
	 *
	 *
	 * @return     boolean  The company list.
	 */
	public static function get_company_list()
	{
		$query = "SELECT products.company AS `company` FROM products GROUP BY products.company ORDER BY COUNT(*) DESC";
		return \dash\db::get($query, 'company');
	}


	/**
	 * Gets the unit list.
	 *
	 *
	 * @return     boolean  The unit list.
	 */
	public static function get_unit_list()
	{
		$query = "SELECT products.unit AS `unit` FROM products GROUP BY products.unit ORDER BY COUNT(*) DESC";
		return \dash\db::get($query, 'unit');
	}


	public static function get_all_product()
	{
		$query =
		"
			SELECT
				*
			FROM
				products
		";
		return \dash\db::get($query);

	}


	public static function get_count()
	{
		return \dash\db\config::public_get_count('products', ...func_get_args());
	}
}
?>