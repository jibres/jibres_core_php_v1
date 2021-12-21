<?php
namespace lib\db\nic_domain;


class insert
{


	public static function new_record($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `domain` SET $set ";
			if(\dash\pdo::query($query, [], 'nic'))
			{
				return \dash\db::insert_id();
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


	public static function multi_insert($_args)
	{
		$set = \dash\db\config::make_multi_insert($_args);
		if($set)
		{
			$query = " INSERT INTO `domain` $set ";
			return \dash\pdo::query($query, [], 'nic');
		}
	}
}
?>
