<?php
namespace lib\db\store_plugin_action;

class search
{

	public static function list($_param, $_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\pdo\prepare_query::binded_ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM store_plugin_action $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\pagination::pagination_query($pagination_query, $_param, $q['limit']);
		}

		$query =
		"
			SELECT
				store_plugin_action.*,
				store_plugin.plugin,
				store_plugin.zone,
				store_plugin.store_id,
				store_plugin.status as `plugin_status`,
				store_plugin.datestart,
				store_plugin.expiredate,
				store_data.title,
				store_data.logo
			FROM
				store_plugin_action

			LEFT JOIN store_plugin ON store_plugin.id = store_plugin_action.plugin_id
			LEFT JOIN store_data ON store_data.id = store_plugin.store_id
			$q[where]
			$q[order]
			$limit
		";

		$result = \dash\pdo::get($query, $_param);

		return $result;
	}




}
?>