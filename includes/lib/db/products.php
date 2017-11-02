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
			'search_field' => "( products.title LIKE '%__string__%') ",
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

}

?>