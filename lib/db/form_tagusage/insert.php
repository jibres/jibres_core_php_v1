<?php
namespace lib\db\form_tagusage;


class insert
{
	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('form_tagusage', ...func_get_args());
	}


	public static function new_record($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `form_tagusage` SET $set ";
			if(\dash\db::query($query))
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
