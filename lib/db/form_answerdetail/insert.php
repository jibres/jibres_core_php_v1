<?php
namespace lib\db\form_answerdetail;


class insert
{


	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('form_answerdetail', ...func_get_args());
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
		return \dash\pdo\query_template::insert('form_answerdetail', $_args);
	}

}
?>
