<?php
namespace lib\db\products;


class variants
{
	public static function update_all_child($_parent_id, $_update)
	{
		if(!empty($_update))
		{
			$set    = \dash\db\config::make_set($_update);
			$query  = "UPDATE products SET $set WHERE products.parent = $_parent_id";
			$result = \dash\db::query($query);
			return $result;
		}

		return null;
	}

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


	public static function clean_product($_id)
	{
		$query  = "UPDATE products SET products.variants = NULL WHERE products.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
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