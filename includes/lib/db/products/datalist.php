<?php
namespace lib\db\products;

class datalist
{

	public static function all_list($_and, $_or, $_order_sort = null)
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


		$pagination_query = "SELECT COUNT(*) AS `count` FROM products $where ";

		$limit = \dash\db::pagination_query($pagination_query);

		$query =
		"
			SELECT
				products.*,
				IF(products.parent IS NOT NULL, (SELECT parentTitle.title FROM products AS `parentTitle` WHERE parentTitle.id = products.parent LIMIT 1), products.title) AS `title`
			FROM products
				$where $order $limit
		";

		$result = \dash\db::get($query);

		return $result;
	}


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
			$where = 'WHERE '. implode(" AND ", $q);
		}

		$order = null;
		if($_order_sort && is_string($_order_sort))
		{
			$order = $_order_sort;
		}


		$pagination_query = "SELECT COUNT(*) AS `count` FROM products $where ";

		$limit = \dash\db::pagination_query($pagination_query);

		$query = " SELECT products.* FROM products $where $order $limit";

		$result = \dash\db::get($query);

		return $result;
	}
}
?>