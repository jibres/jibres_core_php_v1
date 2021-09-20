<?php
namespace lib\db\discount_dedicated;


class insert
{
	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('discount_dedicated', ...func_get_args());
	}


	public static function new_record($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `discount_dedicated` SET $set ";
			if(\dash\db::query($query))
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
