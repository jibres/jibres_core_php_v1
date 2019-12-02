<?php
namespace lib\db\store;

class search
{

	public static function list($_and, $_or, $_order_sort = null)
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
				store_data.*
			FROM
				store
			INNER JOIN store_data ON store_data.id = store.id

			$where $order $limit";

		$result = \dash\db::get($query);

		return $result;
	}
}
?>