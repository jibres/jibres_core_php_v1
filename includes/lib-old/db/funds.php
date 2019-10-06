<?php
namespace lib\db;

class funds
{

	public static function insert()
	{
		\dash\db\config::public_insert('funds', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function update()
	{
		return \dash\db\config::public_update('funds', ...func_get_args());
	}


	public static function get()
	{
		if($chach = \dash\db\cache::get_cache('funds', func_get_args()))
		{
			return $chach;
		}
		$result = \dash\db\config::public_get('funds', ...func_get_args());
		\dash\db\cache::set_cache('funds', func_get_args(), $result);
		return $result;
	}


	public static function search()
	{
		return \dash\db\config::public_search('funds', ...func_get_args());
	}


	public static function unset_all_detault($_store_id)
	{
		if(!$_store_id || !is_numeric($_store_id))
		{
			return false;
		}

		$query = "UPDATE funds SET funds.default = NULL WHERE funds.store_id = $_store_id";
		return \dash\db::query($query);
	}

}
?>