<?php
namespace lib\db\store_user;


class insert
{
	public static function jibres_new_record($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `store_user` SET $set ";

			if(\dash\db::query($query, 'master'))
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