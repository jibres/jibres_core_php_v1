<?php
namespace dash\db\users;


class get
{
	public static function jibres_user_id($_mobile)
	{
		$query  = "SELECT users.id AS `id` FROM users WHERE users.mobile = '$_mobile' LIMIT 1";
		$result = \dash\db::get($query, 'id', true, 'master');
		return $result;
	}


	public static function by_multi_id($_ids)
	{
		$query  = "SELECT *  FROM users WHERE users.id IN ($_ids) ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function group_by_permission()
	{
		$query  = "SELECT COUNT(*) AS `count`, users.permission  FROM users WHERE users.permission IS NOT NULL GROUP BY users.permission ";
		$result = \dash\db::get($query, ['permission', 'count']);
		return $result;
	}
}
?>