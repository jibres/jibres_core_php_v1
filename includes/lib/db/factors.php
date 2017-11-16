<?php
namespace lib\db;

class factors
{
	/**
	 * insert new factor
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function insert($_args)
	{
		$set = [];
		foreach ($_args as $key => $value)
		{
			if($value)
			{
				$set[] = "factors.$key = '$value' ";
			}
		}

		if(empty($set))
		{
			return null;
		}

		$set = implode(',', $set);

		$query = "INSERT INTO factors SET $set";

		\lib\db::query($query);

		return \lib\db::insert_id();
	}


	/**
	 * update factor
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function update()
	{
		return \lib\db\config::public_update('factors', ...func_get_args());
	}


	public static function search()
	{
		return \lib\db\config::public_search('factors', ...func_get_args());
	}


	/**
	 * get factor detail
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get()
	{
		if($chach = \lib\db\cache::get_cache('factors', func_get_args()))
		{
			return $chach;
		}
		$result = \lib\db\config::public_get('factors', ...func_get_args());
		\lib\db\cache::set_cache('factors', func_get_args(), $result);
		return $result;
	}


	/**
	 * delete one factor by id
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

		$query = "DELETE FROM factors WHERE id = $_id LIMIT 1";
		return \lib\db::query($query);
	}

}
?>
