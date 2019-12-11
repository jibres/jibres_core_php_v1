<?php
namespace lib\db\products;


class update
{
	// UPDATE VARIANTS FIELD
	public static function variants($_variants, $_id)
	{
		$query  = "UPDATE products SET products.variants = '$_variants' WHERE products.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function variant_child($_id)
	{
		$query  = "UPDATE products SET products.variant_child = 1 WHERE products.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function variant_child_calc($_id)
	{
		$query  = "SELECT products.id AS `id` FROM products WHERE products.parent = $_id LIMIT 1";
		$have_child = \dash\db::get($query, 'id', true);

		$have_child = $have_child ? 1 : null;
		if(!$have_child)
		{
			$query  = "UPDATE products SET products.variant_child = NULL WHERE products.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
	}


}
?>