<?php
namespace lib\db\producttag;


class insert
{
	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('producttag', ...func_get_args());
	}

	public static function new_record($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `producttag` SET $set ";
			if(\dash\db::query($query))
			{
				return \dash\db::insert_id();;
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



	public static function apply_to_all_product($_tag_id)
	{
		$query_delete_current_tag = "DELETE FROM producttagusage WHERE producttagusage.producttag_id = $_tag_id ";
		\dash\db::query($query_delete_current_tag);

		$query = "INSERT INTO `producttagusage` (`producttag_id`,`product_id`) SELECT $_tag_id, products.id FROM products WHERE products.status != 'deleted' ";
		$result = \dash\db::query($query);
		return $result;

	}
}
?>
