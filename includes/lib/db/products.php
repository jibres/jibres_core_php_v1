<?php
namespace lib\db;

class products
{

	use \lib\db\product\search;
	use \lib\db\product\dashboard;


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


	// get count of produc by one unit
	public static function get_count_unit($_store_id, $_unit_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM products WHERE products.store_id = $_store_id AND products.unit_id = $_unit_id";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	// update all product unit by new unit
	public static function update_all_product_by_unit($_store_id, $_new_unit_id, $_new_unit_title, $_old_unit_id)
	{
		if(is_null($_new_unit_id))
		{
			$_new_unit_id = "NULL";
		}

		if(is_null($_new_unit_title))
		{
			$_new_unit_title = "NULL";
		}
		else
		{
			$_new_unit_title = \dash\db\safe::value($_new_unit_title);
			$_new_unit_title = "'$_new_unit_title'";
		}


		$query =
		"
			UPDATE
				product
			SET
				product.unit    = $_new_unit_title
				product.unit_id = $_new_unit_id
			WHERE
				product.store_id = $_store_id AND
				product.unit_id  = $_old_unit_id
		";

		$result = \dash\db::query($query);
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
	public static function insert($_args)
	{
		\dash\db\config::public_insert('products', ...func_get_args());
		$id = \dash\db::insert_id();
		if($id && isset($_args['cat_id']))
		{
			\lib\db\productterms::update_count(\lib\store::id(), ['type' => 'cat']);
		}
		return $id;
	}


	/**
	 * update product
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function update($_args, $_id)
	{
		$result = \dash\db\config::public_update('products', ...func_get_args());

		if(isset($_args['cat_id']))
		{
			\lib\db\productterms::update_count(\lib\store::id(), ['type' => 'cat']);
		}

		return $result;
	}

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
		return \dash\db::get($query);
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