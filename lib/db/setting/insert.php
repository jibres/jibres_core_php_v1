<?php
namespace lib\db\setting;


class insert
{

	public static function default_setting($_cat, $_key, $_value, $_fuel, $_database)
	{
		$query =
		"
			INSERT INTO setting (`cat`, `key`, `value`)
			SELECT
				'$_cat', '$_key', '$_value'
			FROM
				setting AS `settingSelect`
			WHERE
				NOT EXISTS
				(
					SELECT
						*
					FROM
						setting AS `settingSelect2`
					WHERE
						settingSelect2.cat = '$_cat' AND
						settingSelect2.key = '$_key'
					LIMIT 1
				)
			LIMIT 1;
		";
		$result = \dash\db::query($query, $_fuel, ['database' => $_database]);
		return $result;
	}



	public static function insert_fuel($_set, $_fuel, $_database)
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