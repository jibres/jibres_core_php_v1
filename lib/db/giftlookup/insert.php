<?php
namespace lib\db\giftlookup;


class insert
{


	public static function new_record($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `giftlookup` SET $set ";
			if(\dash\pdo::query($query, []))
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
