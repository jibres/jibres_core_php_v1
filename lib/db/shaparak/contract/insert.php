<?php
namespace lib\db\shaparak\contract;


class insert
{


	public static function new_record($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `contract` SET $set ";
			if(\dash\pdo::query($query, [], 'shaparak'))
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
