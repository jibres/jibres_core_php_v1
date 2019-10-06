<?php
namespace lib\pardakhtyar\db;


class shop
{


	public static function get_by_id($_id)
	{
		$query = "SELECT * FROM shop WHERE shop.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;

	}


	public static function get_by_customer_id($_id)
	{
		$query = "SELECT * FROM shop WHERE shop.customer_id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;

	}




	public static function check_duplicate($_args, $_id)
	{
		$where = \dash\db\config::make_where($_args);
		$query = "SELECT * FROM shop WHERE $where LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;

	}

	public static function insert($_args)
	{
		\dash\db\config::public_insert('shop', $_args);
		return \dash\db::insert_id();
	}


	public static function multi_insert($_args)
	{
		return \dash\db\config::public_multi_insert('shop', $_args);
	}


	public static function update($_args, $_id)
	{
		return \dash\db\config::public_update('shop', $_args, $_id);
	}


	public static function get($_where, $_option = [])
	{
		return \dash\db\config::public_get('shop', $_where);
	}


	public static function search($_string = null, $_option = [])
	{
		$default =
		[

		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default, $_option);

		$result = \dash\db\config::public_search('shop', $_string, $_option);
		return $result;
	}
}
?>