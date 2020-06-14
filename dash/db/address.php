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

	public static function get_user_address($_user_id, $_id)
	{
		$query = "SELECT * FROM address WHERE address.id = $_id AND address.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function get_user_address_active($_user_id, $_id)
	{
		$query = "SELECT * FROM address WHERE address.id = $_id AND address.user_id = $_user_id AND address.status = 'enable' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function user_address_list($_user_id)
	{
		$query = "SELECT * FROM address WHERE address.user_id = $_user_id AND address.status = 'enable' ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function last_user_address($_user_id)
	{
		$query = "SELECT * FROM address WHERE address.user_id = $_user_id AND address.status = 'enable' ORDER BY address.id DESC LIMIT 1";
		$result = \dash\db::get($query, null, true);
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
