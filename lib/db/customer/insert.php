<?php
namespace lib\db\customer;


class insert
{
	private static function check_unique($_args, $_feul, $_database)
	{
		if(isset($_args['jibres_user_id']) && $_args['jibres_user_id'] && is_numeric($_args['jibres_user_id']))
		{
			$query = " SELECT users.id AS `id` FROM users WHERE users.jibres_user_id = $_args[jibres_user_id] LIMIT 1";
			$result = \dash\db::get($query, 'id', true, $_feul, ['database' => $_database]);
			return $result;
		}

		return false;
	}


	public static function user($_args, $_feul, $_database)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);

		if($set)
		{
			$check_unique = self::check_unique($_args, $_feul, $_database);

			if($check_unique)
			{
				return $check_unique;
			}

			$query        = " INSERT INTO `users` SET $set ";

			if(\dash\db::query($query, $_feul, ['database' => $_database]))
			{
				$id = \dash\db::insert_id();
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