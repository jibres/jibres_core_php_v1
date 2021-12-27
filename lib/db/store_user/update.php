<?php
namespace lib\db\store_user;


class update
{

	public static function jibres_store_user_update($_store_id, $_user_id, $_args)
	{

		$q      = \dash\pdo\prepare_query::generate_set('store_user', $_args);

		$query  = "UPDATE store_user SET $q[set] WHERE  store_user.store_id = :store_id AND store_user.user_id = :user_id LIMIT 1";

		$param  = array_merge($q['param'], [':store_id' => $_store_id, ':user_id' => $_user_id]);

		$result = \dash\pdo::query($query, $param, 'master');

		return $result;
	}
}
?>