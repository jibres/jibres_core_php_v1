<?php
namespace lib\db\domains;


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
		return \dash\pdo\query_template::insert('domains', $_args, 'nic_log');
	}


	public static function new_record_activity($_args)
	{
		return \dash\pdo\query_template::insert('domainactivity', $_args, 'nic_log');
	}
}
?>
