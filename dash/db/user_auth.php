<?php
namespace dash\db;


class user_auth
{

	public static function insert()
	{
		return \dash\pdo\query_template::insert('user_auth', ...func_get_args());
	}


	public static function multi_insert()
	{
		return \dash\pdo\query_template::multi_insert('user_auth', ...func_get_args());
	}


	public static function update()
	{
		return \dash\pdo\query_template::update('user_auth', ...func_get_args());
	}



	public static function get()
	{
		return \dash\db\config::public_get('user_auth', ...func_get_args());
	}


	public static function jibres_get($_where)
	{
		// db_name = fuel
		return \dash\db\config::public_get('user_auth', $_where, ['db_name' => 'master']);
	}

	public static function get_count()
	{
		return \dash\pdo\query_template::get_count('user_auth', ...func_get_args());
	}



	public static function hard_delete($_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			return false;
		}

		$query = "DELETE FROM user_auth WHERE user_auth.id = $_id LIMIT 1";
		return \dash\pdo::query($query, []);
	}

}
?>
