<?php
namespace lib\db\store_plugin_action;


class get
{




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