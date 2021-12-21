<?php
namespace lib\db\import;


class insert
{

	public static function new_record($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `importexport` SET $set ";
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
