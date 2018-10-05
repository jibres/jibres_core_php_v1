<?php
namespace lib\db;

class inventory
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

		$query  = "SELECT * FROM inventory WHERE `product_id` = $_product_id AND `enddate` IS NULL ORDER BY `id` DESC LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	/**
	 * insert new productprice
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function insert()
	{
		\dash\db\config::public_insert('inventory', ...func_get_args());
		return \dash\db::insert_id();
	}


	/**
	 * update productprice
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function update()
	{
		return \dash\db\config::public_update('inventory', ...func_get_args());
	}


	/**
	 * get productprice detail
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get()
	{
		if($chach = \dash\db\cache::get_cache('inventory', func_get_args()))
		{
			return $chach;
		}
		$result = \dash\db\config::public_get('inventory', ...func_get_args());
		\dash\db\cache::set_cache('inventory', func_get_args(), $result);
		return $result;
	}


	/**
	 * Searches for the first match.
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function search()
	{
		return \dash\db\config::public_search('inventory', ...func_get_args());
	}


	/**
	 * delete by where
	 *
	 * @param      <type>   $_where  The where
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function delete_where($_where)
	{
		$where = \dash\db\config::make_where($_where);
		if($where)
		{
			$query = "DELETE FROM inventory WHERE $where";
			return \dash\db::query($query);
		}
		return false;
	}
}
?>