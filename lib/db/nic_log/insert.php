<?php
namespace lib\db\nic_log;


class insert
{


	public static function new_record($_args)
	{

		$set = \dash\db\config::make_set($_args, ['type' => 'update']);

		if($set)
		{
			$query = " INSERT INTO `log` SET $set ";

			if(\dash\pdo::query($query, [], 'nic_log'))
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
}
?>
