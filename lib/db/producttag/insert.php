<?php
namespace lib\db\producttag;


class insert
{
	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('producttag', ...func_get_args());
	}

	public static function new_record($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `producttag` SET $set ";
			if(\dash\db::query($query))
			{
				return true;
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
