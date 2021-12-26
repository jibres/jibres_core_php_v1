<?php
namespace dash\db;


class userdetail
{


	public static function insert()
	{
		\dash\pdo\query_template::insert('userdetail', ...func_get_args());
	}


	public static function insert_multi()
	{
		return \dash\pdo\query_template::multi_insert('userdetail', ...func_get_args());
	}


	public static function update()
	{
		return \dash\pdo\query_template::update('userdetail', ...func_get_args());
	}


	public static function update_where()
	{
		return \dash\db\config::public_update_where('userdetail', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('userdetail', ...func_get_args());
	}


	public static function get_count()
	{
		return \dash\db\config::public_get_count('userdetail', ...func_get_args());
	}



}
?>
