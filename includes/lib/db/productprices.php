<?php
namespace lib\db;

class productprices
{
	/**
	 * get last of product id
	 *
	 * @param      <type>  $_product_id  The product identifier
	 */
	public static function last($_product_id)
	{
		if(!$_product_id || !is_numeric($_product_id))
		{
			return false;
		}

		$query  = "SELECT * FROM productprices WHERE `product_id` = $_product_id AND `enddate` IS NULL ORDER BY id DESC LIMIT 1";
		$result = \lib\db::get($query, null, true);
		return $result;
	}



	/**
	 * insert new productprice
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function insert()
	{
		\lib\db\config::public_insert('productprices', ...func_get_args());
		return \lib\db::insert_id();
	}


	/**
	 * update productprice
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function update()
	{
		return \lib\db\config::public_update('productprices', ...func_get_args());
	}


	/**
	 * get productprice detail
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get()
	{
		if($chach = \lib\db\cache::get_cache('productprices', func_get_args()))
		{
			return $chach;
		}
		$result = \lib\db\config::public_get('productprices', ...func_get_args());
		\lib\db\cache::set_cache('productprices', func_get_args(), $result);
		return $result;
	}


	/**
	 * Searches for the first match.
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function search()
	{
		return \lib\db\config::public_search('productprices', ...func_get_args());
	}

}

?>