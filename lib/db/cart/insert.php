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
		return \dash\pdo\query_template::insert('cart', $_args);
	}

	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('cart', ...func_get_args());
	}
}
?>
