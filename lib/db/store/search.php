<?php
namespace lib\db\store;

class search
{

	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM store $q[join] $q[where]";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query =
		"
			SELECT
				store.*,
				store_data.*
			FROM
				store
				$q[join]

			$q[where] $q[order] $limit
		";

		$result = \dash\db::get($query, null, false);

		return $result;
	}



	public static function list_analytics($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM store INNER JOIN store_data ON store_data.id = store.id
			LEFT JOIN store_analytics ON store_analytics.id = store.id $q[where]";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query =
		"
			SELECT
				store.*,
				store_data.*,
				store_analytics.*
			FROM
				store
			INNER JOIN store_data ON store_data.id = store.id
			LEFT JOIN store_analytics ON store_analytics.id = store.id

			$q[where] $q[order] $limit
		";

		$result = \dash\db::get($query, null, false);

		return $result;
	}


	public static function list_domain($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM store_domain INNER JOIN store_data ON store_data.id = store_domain.store_id $q[where]";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query =
		"
			SELECT
				store_domain.*,
				store_data.title
			FROM
				store_domain
			INNER JOIN store_data ON store_data.id = store_domain.store_id

			$q[where] $q[order] $limit
		";

		$result = \dash\db::get($query, null, false);

		return $result;
	}




}
?>
