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
}
?>