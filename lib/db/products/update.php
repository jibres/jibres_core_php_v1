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


	public static function update_all_unit($_new_unit_id, $_old_unit_id)
	{
		$query  = "UPDATE products SET products.unit_id = $_new_unit_id WHERE products.unit_id = $_old_unit_id";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function clean_all_unit($_old_unit_id)
	{
		$query  = "UPDATE products SET products.unit_id = NULL WHERE products.unit_id = $_old_unit_id";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function update_all_company($_new_company_id, $_old_company_id)
	{
		$query  = "UPDATE products SET products.company_id = $_new_company_id WHERE products.company_id = $_old_company_id";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function clean_all_company($_old_company_id)
	{
		$query  = "UPDATE products SET products.company_id = NULL WHERE products.company_id = $_old_company_id";
		$result = \dash\db::query($query);
		return $result;
	}





	public static function record($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'update']);
		if($set)
		{
			$query = " UPDATE `products` SET $set WHERE products.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
		else
		{
			return false;
		}
	}



	public static function thumb($_thumb, $_id)
	{
		if($_thumb)
		{
			$query  = "UPDATE products SET products.thumb = '$_thumb' WHERE products.id = $_id LIMIT 1";
		}
		else

		{
			$query  = "UPDATE products SET products.thumb = NULL WHERE products.id = $_id LIMIT 1";
		}
		$result = \dash\db::query($query);
		return $result;
	}


	public static function gallery($_gallery, $_id)
	{
		$query  = "UPDATE products SET products.gallery = '$_gallery' WHERE products.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}



	public static function status($_status, $_id)
	{
		$query  = "UPDATE products SET products.status = '$_status' WHERE products.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function variants_update_all_child($_parent_id, $_update)
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



	public static function variants_update($_variants, $_id)
	{
		$query  = "UPDATE products SET products.variants = '$_variants' WHERE products.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function variants_clean_product($_id)
	{
		$query  = "UPDATE products SET products.variants = NULL WHERE products.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}



}
?>