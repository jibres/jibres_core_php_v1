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
		return \lib\db\config::public_insert('products', ...func_get_args());
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
	public static function search()
	{
		return \lib\db\config::public_search('products', ...func_get_args());
	}

}

?>