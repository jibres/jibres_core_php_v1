<?php
namespace lib\db\cart;


class search
{


	public static function list($_and = null, $_or = null, $_order_sort = null, $_meta = [])
	{

		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query =
		"
			SELECT
				COUNT(myCartTable.id) AS `count`
			FROM
			(
				SELECT
					IFNULL(cart.user_id, cart.guestid) AS `id`
				FROM
					cart
				LEFT JOIN products ON products.id = cart.product_id
				LEFT JOIN users ON users.id = cart.user_id
					$q[where]
				GROUP BY
					IFNULL(cart.user_id, cart.guestid)
			) AS `myCartTable`
		";

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
				MAX(cart.user_id) AS `user_id`,
				MAX(cart.guestid) AS `guestid`
			FROM cart
			LEFT JOIN products ON products.id = cart.product_id
			LEFT JOIN users ON users.id = cart.user_id
			$q[where]
			GROUP by IFNULL(cart.user_id, cart.guestid)
			$q[order]
			$limit
		";

		$result = \dash\db::get($query);


		return $result;

	}



	public static function detail($_and = null, $_or = null, $_order_sort = null, $_meta = [])
	{

		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);


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
				products.title,
				products.slug,
				(IF(products.thumb IS NULL AND products.parent IS NOT NULL, (SELECT pProduct.thumb FROM products AS pProduct WHERE pProduct.id = products.parent LIMIT 1), products.thumb)) AS `thumb`,
				products.finalprice,
				products.vatprice,
				products.discount,
				products.trackquantity,
				products.instock,
				products.status,
				products.optionname1,
				products.optionvalue1,
				products.optionname2,
				products.optionvalue2,
				products.optionname3,
				products.optionvalue3,
				products.oversale,
				products.minsale,
				products.maxsale,
				products.price AS `product_price`,
				(SELECT productunit.title FROM productunit WHERE productunit.id = products.unit_id LIMIT 1) AS `unit`,
				(SELECT productinventory.stock FROM productinventory WHERE productinventory.product_id = products.id ORDER BY productinventory.id DESC LIMIT 1) AS `stock`
			FROM cart
			LEFT JOIN users ON cart.user_id = users.id
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