<?php
namespace dash\db\comments;


class insert
{
	public static function new_record($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `comments` SET $set ";

			if(\dash\pdo::query($query, []))
			{
				$id = \dash\pdo::insert_id();
				return $id;
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