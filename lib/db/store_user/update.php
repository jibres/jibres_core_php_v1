<?php
namespace lib\db\store_user;


class update
{

	public static function jibres_store_user_update($_store_id, $_user_id, $_set)
	{
		$set = \dash\db\config::make_set($_set);
		$query  = "UPDATE store_user SET $set WHERE  store_user.store_id = $_store_id AND store_user.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}
}
?>