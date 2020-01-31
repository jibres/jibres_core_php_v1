<?php
namespace lib\db\products;

class search
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



	public static function list_join_price($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = self::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =	"SELECT COUNT(*) AS `count`	FROM products $q[where]";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query =
		"
			SELECT
				products.*
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

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query = "SELECT products.* FROM products $q[where] $q[order] $limit ";

		$result = \dash\db::get($query);

		return $result;
	}



	public static function list_join_price_factor_count($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = self::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM products $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}


		$query =
		"
			SELECT
				products.*,
				(SELECT COUNT(*) FROM factordetails WHERE factordetails.product_id = products.id) AS `count_sale`
			FROM products
				$q[where]
			ORDER BY `count_sale` DESC
				 $limit
		";

		$result = \dash\db::get($query);


		return $result;
	}


	public static function list_join_tag($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = self::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =
		"
			SELECT COUNT(*) AS `count` FROM products INNER JOIN producttagusage ON producttagusage.product_id = products.id $q[where]
		";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}


		$query =
		"
			SELECT
				products.*,
				(SELECT COUNT(*) FROM factordetails WHERE factordetails.product_id = products.id) AS `count_sale`
			FROM products
			INNER JOIN producttagusage ON producttagusage.product_id = products.id
				$q[where]
			ORDER BY `count_sale` DESC
				 $limit
		";

		$result = \dash\db::get($query);

		return $result;
	}



}
?>