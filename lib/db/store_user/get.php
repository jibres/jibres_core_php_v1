<?php
namespace lib\db\store_user;


class get
{

	public static function jibres_check_store_user_record($_store_id, $_user_id)
	{
		$query  = "SELECT * FROM store_user WHERE  store_user.store_id = $_store_id AND store_user.user_id = $_user_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true, 'master');
		return $result;
	}

	public static function by_store_id_user_id($_store_id, $_user_id)
	{
		$query  = "SELECT * FROM store_user WHERE  store_user.store_id = $_store_id AND store_user.user_id = $_user_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true, 'master');
		return $result;
	}
}
?>