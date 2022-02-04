<?php
namespace lib\db\store_plugin_action;


class get
{
	public static function active_plugin_package_count($_plugin_id)
	{
		$query =
		"
			SELECT
				SUM(IFNULL(store_plugin_action.packagecount, 0)) AS `packagecount`
			FROM
				store_plugin_action
			WHERE
				store_plugin_action.plugin_id = :plugin_id AND
				store_plugin_action.status    IN ('enable', 'used')
		";

		$param =
		[
			':plugin_id' => $_plugin_id,
		];

		$result = \dash\pdo::get($query, $param, 'packagecount', true);

		return $result;
	}

	public static function max_expire_date($_plugin_id)
	{
		$query =
		"
			SELECT
				store_plugin_action.expiredate AS `expiredate`
			FROM
				store_plugin_action
			WHERE
				store_plugin_action.plugin_id = :plugin_id AND
				store_plugin_action.status    = 'enable'
			ORDER BY
				store_plugin_action.expiredate DESC
			LIMIT 1
		";

		$param =
		[
			':plugin_id' => $_plugin_id,
		];

		$result = \dash\pdo::get($query, $param, 'expiredate', true);

		return $result;
	}


	public static function by_id($_id)
	{
		$query = "SELECT * FROM store_plugin_action WHERE store_plugin_action.id = :id LIMIT 1";

		$param =
		[
			':id' => $_id,
		];

		$result = \dash\pdo::get($query, $param, null, true);

		return $result;
	}
}
?>