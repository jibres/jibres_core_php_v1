<?php
namespace dash\db;


class address
{
	public static function get_count_user_address($_user_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM address WHERE address.user_id = $_user_id";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function insert()
	{
		\dash\db\config::public_insert('address', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('address', ...func_get_args());
	}


	public static function update()
	{
		return \dash\db\config::public_update('address', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('address', ...func_get_args());
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('address', ...func_get_args());
	}


	public static function search()
	{
		$result = \dash\db\config::public_search('address', ...func_get_args());
		return $result;
	}

}
?>
