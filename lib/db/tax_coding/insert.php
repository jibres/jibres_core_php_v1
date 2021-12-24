<?php
namespace lib\db\tax_coding;


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
		if(isset($_args['code']))
		{
			$query = "SELECT * FROM tax_coding WHERE tax_coding.code = '$_args[code]' LIMIT 1";
			$result = \dash\pdo::get($query, [], null, true);
			if(isset($result['id']))
			{
				\dash\notif::error(T_("Duplicate code"));
				return false;
			}
		}

		return \dash\pdo\query_template::insert('tax_coding', $_args);
	}

}
?>
