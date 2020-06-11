<?php
namespace lib\db\cart;


class insert
{


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
			$query = " INSERT INTO `cart` SET $set ";
			if(\dash\db::query($query))
			{
				return true;
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

	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('cart', ...func_get_args());
	}
}
?>
