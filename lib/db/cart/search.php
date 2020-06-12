<?php
namespace lib\db\cart;


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



	public static function list($_and = null, $_or = null, $_order_sort = null, $_meta = [])
	{

		$q = self::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =	"SELECT COUNT(*) AS `count`	FROM cart LEFT JOIN users ON cart.user_id = users.id $q[where] GROUP BY cart.user_id";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query =
		"
			SELECT
				COUNT(*) AS `item_count`,
				SUM(cart.count) AS `product_count`,
				MAX(cart.datecreated) AS `datecreated`,
				cart.user_id,
				users.displayname,
				users.avatar,
				users.mobile,
				users.gender
			FROM cart
			LEFT JOIN users ON cart.user_id = users.id
			$q[where]
			GROUP by cart.user_id
			$q[order]
			$limit
		";

		$result = \dash\db::get($query);


		return $result;

	}



	public static function detail($_and = null, $_or = null, $_order_sort = null, $_meta = [])
	{

		$q = self::ready_to_sql($_and, $_or, $_order_sort, $_meta);


		$pagination_query =	"SELECT COUNT(*) AS `count`	FROM cart INNER JOIN users ON cart.user_id = users.id INNER JOIN products ON products.id = cart.product_id $q[where]";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}

		$query =
		"
			SELECT
				cart.*,
				users.displayname,
				users.avatar,
				users.mobile,
				products.title
			FROM cart
			INNER JOIN users ON cart.user_id = users.id
			INNER JOIN products ON products.id = cart.product_id
			$q[where]
			$q[order]
			$limit
		";

		$result = \dash\db::get($query);


		return $result;

	}


}
?>