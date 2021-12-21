<?php
namespace lib\db\productcategory;


class insert
{
	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('productcategory', ...func_get_args());
	}

	/**
	 * Insert new record to product category table
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function new_record($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `productcategory` SET $set ";
			if(\dash\pdo::query($query, []))
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


	public static function apply_to_all_product($_cat_id)
	{
		$query_delete_current_tag = "DELETE FROM productcategoryusage WHERE productcategoryusage.productcategory_id = $_cat_id ";
		\dash\pdo::query($query_delete_current_tag, []);

		$query = "INSERT INTO `productcategoryusage` (`productcategory_id`,`product_id`) SELECT $_cat_id, products.id FROM products WHERE products.status != 'deleted' ";
		$result = \dash\pdo::query($query, []);
		return $result;

	}
}
?>
