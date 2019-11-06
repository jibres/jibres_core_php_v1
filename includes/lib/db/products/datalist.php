<?php
namespace lib\db\products;

class datalist
{
	private static function ready_to_sql($_and, $_or, $_order_sort = null, $_meta = [])
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

		return
		[
			'where' => $where,
			'order' => $order,
		];
	}



	public static function list_join_price($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = self::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =
		"
			SELECT COUNT(*) AS `count`
			FROM products
			LEFT JOIN productprices ON productprices.product_id = products.id AND productprices.last = 'yes'
			$q[where]
		";

		$limit = \dash\db::pagination_query($pagination_query);

		$query =
		"
			SELECT
				products.*,
				productprices.buyprice,
				productprices.price,
				productprices.discount

			FROM products
			LEFT JOIN productprices ON productprices.product_id = products.id AND productprices.last = 'yes'
				$q[where] $q[order] $limit
		";

		$result = \dash\db::get($query);

		return $result;

	}



	public static function all_list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = self::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM products $q[where] ";

		$limit = \dash\db::pagination_query($pagination_query);

		$query =
		"
			SELECT
				products.*,
				IF(products.parent IS NOT NULL, (SELECT parentTitle.title FROM products AS `parentTitle` WHERE parentTitle.id = products.parent LIMIT 1), products.title) AS `title`
			FROM products
				$q[where] $q[order] $limit
		";

		$result = \dash\db::get($query);

		return $result;
	}



	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = self::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM products $q[where] ";

		$limit = \dash\db::pagination_query($pagination_query);

		$query = " SELECT products.* FROM products $q[where] $q[order] $limit";

		$result = \dash\db::get($query);

		return $result;
	}
}
?>