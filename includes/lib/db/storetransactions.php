<?php
namespace lib\db;

class storetransactions
{
	public static function insert()
	{
		\dash\db\config::public_insert('storetransactions', ...func_get_args());
		return \lib\db::insert_id();
	}


	public static function update()
	{
		return \dash\db\config::public_update('storetransactions', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('storetransactions', ...func_get_args());
	}


	public static function search()
	{
		return \dash\db\config::public_search('storetransactions', ...func_get_args());
	}

}
?>