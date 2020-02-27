<?php
namespace lib\db\store;

class search
{

	private static function ready_to_sql($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$where = null;
		$q     = [];

		if($_and)
		{
			$_and = implode(' AND ', $_and);
			$q[] = "$_and";

		}

		if($_or)
		{
			$_or = implode(' OR ', $_or);
			$q[] = "($_or)";
		}

		if($q)
		{
			$where = 'WHERE '. implode(" AND ", $q);
		}

		$order = null;
		if($_order_sort && is_string($_order_sort))
		{
			$order = $_order_sort;
		}

		$pagination = null;
		if(array_key_exists('pagination', $_meta))
		{
			$pagination = $_meta['pagination'];
		}

		$limit = null;
		if(array_key_exists('limit', $_meta))
		{
			$limit = $_meta['limit'];
		}

		return
		[
			'where'      => $where,
			'order'      => $order,
			'pagination' => $pagination,
			'limit'      => $limit,
		];
	}





	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = self::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM store $q[where]";

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
			INNER JOIN store_data ON store_data.id = store.id
			$q[where] $q[order] $limit
		";

		$result = \dash\db::get($query, null, false);

		return $result;
	}




	public static function analytics($_and, $_or, $_order_sort = null)
	{
		$where = null;
		$q     = [];

		if($_and)
		{
			$q[] = \dash\db\config::make_where($_and, ['condition' => 'AND']);
		}

		if($_or)
		{
			$or =  \dash\db\config::make_where($_or, ['condition' => 'OR']);
			$q[] = "($or)";
		}

		if($q)
		{
			$where = 'WHERE '. implode($q, " AND ");
		}

		$order = null;
		if($_order_sort && is_string($_order_sort))
		{
			$order = $_order_sort;
		}


		$pagination_query =
		"
			SELECT COUNT(*) AS `count` FROM
			store
				INNER JOIN store_data ON store_data.id = store.id
			$where
		";

		$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query);

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

			$where $order $limit";

		$result = \dash\db::get($query);

		return $result;
	}
}
?>
