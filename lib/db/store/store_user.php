<?php
namespace lib\db\store;


class store_user
{
	public static function get_my_store($_user_id)
	{
		$query =
		"
			SELECT
				store.*,
				store_user.*,
				store.id AS `store_id`,
				store_data.title,
				store_data.owner,
				store_data.plan,
				store_data.startplan,
				store_data.expireplan,
				store_data.logo,
				store_analytics.product,
				store_analytics.customer,
				store_analytics.factor,
				store_analytics.lastactivity
			FROM
				store_user
			INNER JOIN store ON store.id = store_user.store_id
			LEFT JOIN store_data ON store_data.id = store_user.store_id
			LEFT JOIN store_analytics ON store_analytics.id = store_user.store_id
			WHERE store_user.user_id = $_user_id
		";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>