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
		$result = \dash\pdo::query($query, [], $_fuel, ['database' => $_database]);
		return $result;
	}

	public static function single_insert_fuel($_set, $_fuel, $_database)
	{
		$set_setting = \dash\db\config::make_set($_set);

		$query = "INSERT INTO `$_database`.`setting` SET $set_setting";
		$result = \dash\pdo::query($query, [], $_fuel, ['database' => $_database]);
	}


	public static function insert_fuel($_set, $_fuel, $_database)
	{
		$set_setting = \dash\db\config::make_multi_insert($_set);

		$query = "INSERT INTO `$_database`.`setting` $set_setting";
		$result = \dash\pdo::query($query, [], $_fuel, ['database' => $_database]);
	}


	public static function new_record($_args, $_check_duplicate_cat_key = false)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			if($_check_duplicate_cat_key && a($_args, 'cat') && a($_args, 'key'))
			{
				$insert_ready = \dash\db\config::make_multi_insert([$_args], true);
				if(a($insert_ready, 'fields') && a($insert_ready, 'values'))
				{
					$query =
					"
						INSERT INTO `setting` ($insert_ready[fields])
						SELECT * FROM (SELECT $insert_ready[values]) AS tmp
						WHERE NOT EXISTS
						(
						    SELECT check_setting.id FROM `setting` as `check_setting` WHERE  check_setting.cat = '$_args[cat]' AND check_setting.key = '$_args[key]'
						) LIMIT 1;
					";

					if(\dash\pdo::query($query, []))
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

			$query = " INSERT INTO `setting` SET $set ";

			if(\dash\pdo::query($query, []))
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