<?php
namespace lib\db;

class stores
{


	/**
	 * Gets the similar slug.
	 * GET list of slug like this
	 * for change when duplicate
	 * @param      <type>  $_like  The like
	 *
	 * @return     <type>  The similar slug.
	 */
	public static function get_similar_slug($_like)
	{
		$query = "SELECT stores.slug AS `slug` FROM stores WHERE stores.slug LIKE '$_like%' ";
		return \lib\db::get($query, 'slug');
	}


	/**
	 * insert new store
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function insert()
	{
		\dash\db\config::public_insert('stores', ...func_get_args());
		return \lib\db::insert_id();
	}


	/**
	 * update stores
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function update()
	{
		return \dash\db\config::public_update('stores', ...func_get_args());
	}


	/**
	 * get store detail
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get()
	{
		return \dash\db\config::public_get('stores', ...func_get_args());
	}


	/**
	 * Searches for the first match.
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function search()
	{
		return \dash\db\config::public_search('stores', ...func_get_args());
	}


	/**
	 * Gets the count store by creator.
	 *
	 * @param      <type>  $_creator  The creator
	 */
	public static function get_count_store_by_creator($_creator)
	{
		$query = "SELECT COUNT(*) AS `count` FROM stores WHERE stores.creator = $_creator ";
		$result = \lib\db::get($query, 'count', true);
		return $result;
	}

}

?>