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
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `business_domain` SET $set ";
			if(\dash\pdo::query($query, [], 'master'))
			{
				return \dash\pdo::insert_id();
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


	public static function new_record_action($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `business_domain_action` SET $set ";
			if(\dash\pdo::query($query, [], 'master'))
			{
				return \dash\pdo::insert_id();
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

	public static function new_record_dns($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `business_domain_dns` SET $set ";
			if(\dash\pdo::query($query, [], 'master'))
			{
				return \dash\pdo::insert_id();
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
