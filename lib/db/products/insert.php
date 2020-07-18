<?php
namespace lib\db\products;

class insert
{

	public static function new_record($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `products` SET $set ";
			if(\dash\db::query($query))
			{
				$id = \dash\db::insert_id();
				return $id;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}


	public static function make_duplicate($_new_id, $_old_id)
	{

		$set = [];

		$get_variants = \dash\db::get("SELECT variants FROM products WHERE id = $_old_id LIMIT 1", 'variants', true);
		if($get_variants)
		{
			$set['variants'] = $get_variants;
		}

		$get_thumb = \dash\db::get("SELECT thumb FROM products WHERE id = $_old_id LIMIT 1", 'thumb', true);
		if($get_thumb)
		{
			$set['thumb'] = $get_thumb;
		}

		$get_gallery = \dash\db::get("SELECT gallery FROM products WHERE id = $_old_id LIMIT 1", 'gallery', true);
		if($get_gallery)
		{
			$set['gallery'] = $get_gallery;
		}

		if($set)
		{
			$set   = \dash\db\config::make_set($set);
			$query = "UPDATE products  SET $set WHERE products.id = $_new_id	LIMIT 1";
			\dash\db::query($query);
		}

		$query =
		"
			INSERT INTO productcategoryusage
			(`productcategory_id`, `product_id`)
			SELECT `productcategory_id`, $_new_id
			FROM `productcategoryusage`
			WHERE productcategoryusage.product_id = $_old_id
		";

		\dash\db::query($query);


		$query =
		"
			INSERT INTO producttagusage
			(`producttag_id`, `product_id`)
			SELECT `producttag_id`, $_new_id
			FROM `producttagusage`
			WHERE producttagusage.product_id = $_old_id
		";

		\dash\db::query($query);


		$now = date("Y-m-d H:i:s");

		$query =
		"
			INSERT INTO productproperties
			(`product_id`,`cat`,`key`,`value`,`desc`,`sort`,`datecreated`,`datemodified`,`outstanding`)
			SELECT $_new_id,`cat`,`key`,`value`,`desc`,`sort`,'$now', NULL,`outstanding`
			FROM productproperties
			WHERE productproperties.product_id = $_old_id
		";

		\dash\db::query($query);

	}
}
?>





