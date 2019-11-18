<?php
namespace lib\db\products;


class variants
{

	public static function update($_variants, $_id)
	{
		$query  = "UPDATE products SET products.variants = '$_variants' WHERE products.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function have_child($_id)
	{
		$query  = "SELECT products.id AS `id` FROM products WHERE products.parent = $_id LIMIT 1";
		$result = \dash\db::get($query, 'id', true);
		return $result;
	}


	public static function load_child($_id)
	{
		$query  = "SELECT * FROM products WHERE products.parent = $_id";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function load_child_count($_products_ids)
	{
		$query  =
		"
			SELECT
				products.parent,
				COUNT(*) AS `count`
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