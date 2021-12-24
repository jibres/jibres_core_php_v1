<?php
namespace lib\db\form_view_field;


class insert
{


	public static function multi_insert()
	{
		return \dash\pdo\query_template::multi_insert('form_view_field', ...func_get_args());
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
		return \dash\pdo\query_template::insert('form_view_field', $_args);
	}

}
?>
