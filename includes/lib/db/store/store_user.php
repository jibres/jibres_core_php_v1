<?php
namespace lib\db\store;


class store_user
{
	public static function get_my_store($_user_id)
	{
		$query =
		"
			SELECT
				store_user.*,
				store_data.title,
				store_data.plan,
				store_data.startplan,
				store_data.expireplan,
				store_data.logo
			FROM
				store_user
			INNER JOIN store_data ON store_data.id = store_user.store_id
			WHERE store_user.user_id = $_user_id
		";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>