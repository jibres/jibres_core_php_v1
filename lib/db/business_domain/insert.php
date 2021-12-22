<?php
namespace lib\db\business_domain;


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
		return \dash\pdo\query_template::insert('business_domain', $_args, 'master');
	}


	public static function new_record_action($_args)
	{
		return \dash\pdo\query_template::insert('business_domain_action', $_args, 'master');
	}


	public static function new_record_dns($_args)
	{
		return \dash\pdo\query_template::insert('business_domain_dns', $_args, 'master');
	}


	public static function multi_dns($_args)
	{
		$set = \dash\db\config::make_multi_insert($_args);
		if($set)
		{
			$query = " INSERT INTO `business_domain_dns` $set ";
			return \dash\pdo::query($query, [], 'master');
		}
	}

}
?>
