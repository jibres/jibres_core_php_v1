<?php
namespace lib\db\products2;


class variants
{

	public static function update($_variants, $_id)
	{
		$query  = "UPDATE products2 SET products2.variants = '$_variants' WHERE products2.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function have_child($_id)
	{
		$query  = "SELECT products2.id AS `id` FROM products2 WHERE products2.parent = $_id LIMIT 1";
		$result = \dash\db::get($query, 'id', true);
		return $result;
	}


	public static function load_child_count($_products_ids)
	{
		$query  =
		"
			SELECT
				products2.parent,
				COUNT(*) AS `count`
			FROM
				products2
			WHERE
				products2.parent IN ($_products_ids)
			GROUP BY products2.parent
		";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>