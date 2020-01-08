<?php
namespace lib\db\setting;


class insert
{

	public static function jibres_customer_insert($_database, $_fuel, $_set)
	{
		$set_setting = \dash\db\config::make_multi_insert($_set);

		$query = "INSERT INTO `$_database`.`setting` $set_setting";
		$result = \dash\db::query($query, $_fuel, ['database' => $_database]);
	}


	public static function new_record($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `setting` SET $set ";

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