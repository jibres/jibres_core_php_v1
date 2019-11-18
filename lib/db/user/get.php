<?php
namespace lib\db\user;


class get
{
	public static function user_id_detail($_user_id)
	{
		$query = "SELECT * FROM user WHERE user.user_id = $_user_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function by_id($_id)
	{
		$query = "SELECT * FROM user WHERE user.id = $_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>