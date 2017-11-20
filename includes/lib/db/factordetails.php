<?php
namespace lib\db;

class factordetails
{
	/**
	 * insert new factordetail
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
				$set[] = "factordetails.$key = '$value' ";
			}
		}

		if(empty($set))
		{
			return null;
		}

		$set = implode(',', $set);

		$query = "INSERT INTO factordetails SET $set";

		\lib\db::query($query);

		return \lib\db::insert_id();
	}

	public static function multi_insert()
	{
		return \lib\db\config::public_multi_insert('factordetails', ...func_get_args());
	}

	/**
	 * update factordetail
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function update()
	{
		return \lib\db\config::public_update('factordetails', ...func_get_args());
	}


	public static function search()
	{
		return \lib\db\config::public_search('factordetails', ...func_get_args());
	}


	/**
	 * get factordetail detail
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get()
	{
		if($chach = \lib\db\cache::get_cache('factordetails', func_get_args()))
		{
			return $chach;
		}
		$result = \lib\db\config::public_get('factordetails', ...func_get_args());
		\lib\db\cache::set_cache('factordetails', func_get_args(), $result);
		return $result;
	}


	/**
	 * delete one factordetail by id
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

		$query = "DELETE FROM factordetails WHERE id = $_id LIMIT 1";
		return \lib\db::query($query);
	}

}
?>
