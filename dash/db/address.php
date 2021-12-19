<?php
namespace dash\db;

/**
 * This class describes an address.
 *
 * @author Reza
 *
 * All function of this class convert to mysql bind param query
 * @date 2021-12-19 16:32:22
 *
 */
class address
{

	public static function insert($_args)
	{
		return \dash\db\config::public_insert('address', $_args);
	}


	public static function update()
	{
		return \dash\db\config::public_update('address', ...func_get_args());
	}


	public static function get_by_id($_id)
	{
		return \dash\db\config::public_get_by_id('address', $_id);
	}


	public static function get_count()
	{
		return \dash\db\config::public_get_full_count('address');
	}


	public static function get_count_user_address($_user_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM address WHERE address.user_id = :user_id";
		$param =
		[
			':user_id' => $_user_id,
		];

		$result = \dash\db::get_bind($query, $param, 'count', true);

		return $result;
	}


	public static function get_user_address($_user_id, $_id)
	{
		$query = "SELECT * FROM address WHERE address.id = :id AND address.user_id = :user_id LIMIT 1";
		$param =
		[
			':user_id' => $_user_id,
			':id'      => $_id,
		];

		$result = \dash\db::get_bind($query, $param, null, true);

		return $result;
	}


	public static function get_primary_user_address($_user_id)
	{
		$query = "SELECT * FROM address WHERE address.user_id = :user_id AND address.status = 'enable' ORDER BY address.isdefault DESC, address.id ASC LIMIT 1";
		$param =
		[
			':user_id' => $_user_id,
		];
		$result = \dash\db::get_bind($query, $param, null, true);
		return $result;
	}


	public static function get_user_address_active($_user_id, $_id)
	{
		$query = "SELECT * FROM address WHERE address.id = :id AND address.user_id = :user_id AND address.status = 'enable' LIMIT 1";
		$param =
		[
			':user_id' => $_user_id,
			':id'      => $_id,
		];

		$result = \dash\db::get_bind($query, $param, null, true);
		return $result;
	}


	public static function user_address_list($_user_id)
	{
		$query = "SELECT * FROM address WHERE address.user_id = :user_id AND address.status = 'enable' ";
		$param =
		[
			':user_id' => $_user_id,
		];
		$result = \dash\db::get_bind($query, $param);
		return $result;
	}


	public static function last_user_address($_user_id)
	{
		$query = "SELECT * FROM address WHERE address.user_id = :user_id AND address.status = 'enable' ORDER BY address.id DESC LIMIT 1";
		$param =
		[
			':user_id' => $_user_id,
		];
		$result = \dash\db::get_bind($query, $param, null, true);
		return $result;
	}


	public static function get_by_id_user_id($_id, $_user_id)
	{
		$query = "SELECT * FROM address WHERE address.id = :id AND address.user_id = :user_id LIMIT 1";
		$param =
		[
			':user_id' => $_user_id,
			':id'      => $_id,
		];

		$result = \dash\db::get_bind($query, $param, null, true);
		return $result;
	}
}
?>