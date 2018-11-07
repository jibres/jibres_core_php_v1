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
		return \dash\db::get($query, 'slug');
	}


	/**
	 * insert new store
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function insert()
	{
		\dash\db\config::public_insert('stores', ...func_get_args());
		return \dash\db::insert_id();
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


	public static function get_count()
	{
		return \dash\db\config::public_get_count('stores', ...func_get_args());
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
	public static function search($_string = null, $_option = [])
	{
		$default_option =
		[
			'search_field' =>
			"
				(
					stores.name LIKE '%__string__%'
				)
			",
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		return \dash\db\config::public_search('stores', $_string, $_option);
	}


	/**
	 * Gets the count store by creator.
	 *
	 * @param      <type>  $_creator  The creator
	 */
	public static function get_count_store_by_creator($_creator)
	{
		$query = "SELECT COUNT(*) AS `count` FROM stores WHERE stores.creator = $_creator ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

}

?>