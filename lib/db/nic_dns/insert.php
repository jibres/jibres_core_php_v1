<?php
namespace lib\db\nic_dns;


class insert
{


	public static function new_record($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `dns` SET $set ";
			if(\dash\db::query($query, 'nic'))
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
}
?>
