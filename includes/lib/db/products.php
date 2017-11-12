<?php
namespace lib\db;

class products
{

	/**
	 * insert new product
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function insert()
	{
		\lib\db\config::public_insert('products', ...func_get_args());
		return \lib\db::insert_id();
	}


	/**
	 * update product
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function update()
	{
		return \lib\db\config::public_update('products', ...func_get_args());
	}


	/**
	 * get product detail
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get()
	{
		if($chach = \lib\db\cache::get_cache('products', func_get_args()))
		{
			return $chach;
		}
		$result = \lib\db\config::public_get('products', ...func_get_args());
		\lib\db\cache::set_cache('products', func_get_args(), $result);
		return $result;
	}


	/**
	 * Searches for the first match.
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function search($_string = null, $_option = [])
	{
		$default_option =
		[
			'search_field' => "( products.title LIKE '%__string__%' OR products.barcode = '__string__' OR products.barcode2 = '__string__') ",
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		return \lib\db\config::public_search('products', $_string, $_option);
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
	public static function get_barcode($_barcode)
	{
		if(!$_barcode)
		{
			return false;
		}

		$query = "SELECT * FROM  products WHERE products.barcode = '$_barcode' OR products.barcode2 = '$_barcode' ";
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

		$query = "SELECT products.cat AS `cat` FROM products WHERE products.store_id = $_store_id GROUP BY products.cat ";
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

		$query = "SELECT products.company AS `company` FROM products WHERE products.store_id = $_store_id  GROUP BY products.company ";
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

		$query = "SELECT products.unit AS `unit` FROM products WHERE products.store_id = $_store_id  GROUP BY products.unit ";
		return \lib\db::get($query, 'unit');
	}




}

?>