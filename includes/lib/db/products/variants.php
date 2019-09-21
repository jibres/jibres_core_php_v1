<?php
namespace lib\db\products;


class variants
{

	public static function have_child($_id)
	{
		$query  = "SELECT products.id AS `id` FROM products WHERE products.parent = $_id LIMIT 1";
		$result = \dash\db::get($query, 'id', true);
		return $result;
	}


	public static function load_child_count($_products_ids)
	{
		$query  =
		"
			SELECT
				products.parent,
				COUNT(*) AS `count`,
				SUM(products.stock) AS `stock`
			FROM
				products
			WHERE
				products.parent IN ($_products_ids)
			GROUP BY products.parent
		";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>