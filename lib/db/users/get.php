<?php
namespace lib\db\users;


class get
{
	public static function user_id_detail($_user_id)
	{
		$query = "SELECT * FROM users WHERE users.id = $_user_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function by_id($_id)
	{
		$query = "SELECT * FROM users WHERE users.id = $_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>