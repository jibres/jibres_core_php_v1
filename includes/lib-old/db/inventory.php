<?php
namespace lib\db;

class inventory
{

	public static function insert()
	{
		\dash\db\config::public_insert('inventory', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function update()
	{
		return \dash\db\config::public_update('inventory', ...func_get_args());
	}


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


	public static function search()
	{
		return \dash\db\config::public_search('inventory', ...func_get_args());
	}


	public static function unset_all_detault($_store_id)
	{
		if(!$_store_id || !is_numeric($_store_id))
		{
			return false;
		}

		$query = "UPDATE inventory SET inventory.default = NULL WHERE inventory.store_id = $_store_id";
		return \dash\db::query($query);
	}

}
?>