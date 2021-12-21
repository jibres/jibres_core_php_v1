<?php
namespace dash\db\login;


class insert
{
	public static function new_record($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `login` SET $set ";

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

	public static function new_record_login_ip($_args, $_fuel = null)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `login_ip` SET $set ";

			if(\dash\pdo::query($query, [], $_fuel))
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