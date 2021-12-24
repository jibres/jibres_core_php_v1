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
		return \dash\pdo\query_template::multi_insert('setting', $_set, $_fuel, ['database' => $_database]);
	}


	public static function new_record($_args, $_check_duplicate_cat_key = false)
	{
		if(!$_args)
		{
			return false;
		}

		$setting_field = ['id', 'platform', 'user_id', 'lang', 'datemodified', 'cat', 'key', 'value'];

		if($_check_duplicate_cat_key && a($_args, 'cat') && a($_args, 'key'))
		{
			$param       = [];
			$insert_args = [];
			$select_args = [];

			foreach ($_args as $key => $value)
			{
				$insert_args[]      = " setting.$key ";
				// $param[':'. $key]   = $value;

				$select_args[]      = " :w_{$key} ";
				$param[':w_'. $key] = $value;
			}

			$insert_args = implode(',', $insert_args);
			$select_args = implode(',', $select_args);

			$query =
			"
				INSERT INTO `setting` ($insert_args)
				SELECT * FROM (SELECT $select_args) AS tmp
				WHERE NOT EXISTS
				(
				    SELECT check_setting.id FROM `setting` as `check_setting` WHERE  check_setting.cat = :scat AND check_setting.key = :skey
				) LIMIT 1;
			";

			$param[':scat'] = $_args['cat'];
			$param[':skey'] = $_args['key'];

			return \dash\pdo::query($query, $param);
		}
		else
		{
			return \dash\pdo\query_template::insert('setting', $_args);
		}

	}
}
?>