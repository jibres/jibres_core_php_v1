<?php
namespace lib\db\setting;


class update
{

	public static function record($_args, $_id)
	{
		$result = \dash\pdo\query_template::update('setting', $_args, $_id);
		return $result;
	}

	public static function by_cat_key($_cat, $_key, $_value)
	{
		$now = date("Y-m-d H:i:s");
		$query = "UPDATE setting SET setting.datemodified = '$now', setting.value = '$_value'  WHERE setting.cat = '$_cat' AND setting.key = '$_key' LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function key($_key, $_id)
	{
		$now = date("Y-m-d H:i:s");
		$query = "UPDATE setting SET setting.datemodified = '$now', setting.key = '$_key'  WHERE setting.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function value($_value, $_id)
	{
		$now = date("Y-m-d H:i:s");
		$query = "UPDATE setting SET setting.datemodified = '$now', setting.value = '$_value'  WHERE setting.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}



	public static function overwirte_platform_cat_key($_value, $_platform, $_cat, $_key)
	{
		$now = date("Y-m-d H:i:s");
		$query = "SELECT setting.id, setting.value FROM setting WHERE setting.platform = '$_platform' AND setting.cat = '$_cat' AND setting.key = '$_key' LIMIT 1";
		$check = \dash\pdo::get($query, [], null, true);

		if(isset($check['id']))
		{
			if(isset($check['value']) && $check['value'] === $_value)
			{
				return null;
			}
			else
			{
				$query = "UPDATE setting SET setting.datemodified = '$now', setting.value = '$_value'  WHERE setting.id = $check[id] LIMIT 1";
				$result = \dash\db::query($query);
				return $result;
			}
		}
		else
		{

			$insert =
			[
				'platform' => $_platform,
				'cat'      => $_cat,
				'key'      => $_key,
				'value'    => $_value,
			];

			return \lib\db\setting\insert::new_record($insert);
		}
	}


	public static function overwirte_platform_cat_key_lang($_value, $_platform, $_cat, $_key, $_lang)
	{
		$now = date("Y-m-d H:i:s");
		$query = "SELECT setting.id, setting.value FROM setting WHERE setting.lang = '$_lang' AND setting.platform = '$_platform' AND setting.cat = '$_cat' AND setting.key = '$_key' LIMIT 1";
		$check = \dash\pdo::get($query, [], null, true);

		if(isset($check['id']))
		{
			if(isset($check['value']) && $check['value'] === $_value)
			{
				return null;
			}
			else
			{
				$query = "UPDATE setting SET setting.datemodified = '$now', setting.value = '$_value'  WHERE setting.id = $check[id] LIMIT 1";
				$result = \dash\db::query($query);
				return $result;
			}
		}
		else
		{

			$insert =
			[
				'lang'     => $_lang,
				'platform' => $_platform,
				'cat'      => $_cat,
				'key'      => $_key,
				'value'    => $_value,
			];

			return \lib\db\setting\insert::new_record($insert);
		}
	}


	public static function overwirte_cat_key($_value, $_cat, $_key)
	{
		$now = date("Y-m-d H:i:s");
		$query = "SELECT setting.id, setting.value FROM setting WHERE setting.cat = '$_cat' AND setting.key = '$_key' LIMIT 1";
		$check = \dash\pdo::get($query, [], null, true);

		if(isset($check['id']))
		{
			if(isset($check['value']) && $check['value'] === $_value)
			{
				return null;
			}
			else
			{
				$query = "UPDATE setting SET setting.datemodified = '$now', setting.value = '$_value'  WHERE setting.id = $check[id] LIMIT 1";
				$result = \dash\db::query($query);
				return $result;
			}
		}
		else
		{

			$insert =
			[
				'cat'      => $_cat,
				'key'      => $_key,
				'value'    => $_value,
			];

			return \lib\db\setting\insert::new_record($insert);
		}
	}




	public static function overwirte_cat_key_fuel($_value, $_cat, $_key, $_fuel, $_database)
	{
		$now = date("Y-m-d H:i:s");
		$query = "SELECT setting.id AS `id` FROM setting WHERE setting.cat = '$_cat' AND setting.key = '$_key' LIMIT 1";
		$check = \dash\pdo::get($query, [], 'id', true, $_fuel, ['database' => $_database]);
		if($check)
		{
			$query = "UPDATE setting SET setting.datemodified = '$now', setting.value = '$_value'  WHERE setting.id = $check LIMIT 1";
			$result = \dash\db::query($query, $_fuel, ['database' => $_database]);
			return $result;
		}
		else
		{

			$insert =
			[
				'cat'      => $_cat,
				'key'      => $_key,
				'value'    => $_value,
			];

			return \lib\db\setting\insert::single_insert_fuel($insert, $_fuel, $_database);
		}
	}


	public static function overwirte_platform_cat_key_fuel($_value, $_platform, $_cat, $_key, $_fuel, $_database)
	{
		$now = date("Y-m-d H:i:s");
		$query = "SELECT setting.id AS `id` FROM setting WHERE setting.platform = '$_platform' AND setting.cat = '$_cat' AND setting.key = '$_key' LIMIT 1";
		$check = \dash\pdo::get($query, [], 'id', true, $_fuel, ['database' => $_database]);
		if($check)
		{
			$query = "UPDATE setting SET setting.datemodified = '$now', setting.value = '$_value'  WHERE setting.id = $check LIMIT 1";
			$result = \dash\db::query($query, $_fuel, ['database' => $_database]);
			return $result;
		}
		else
		{

			$insert =
			[
				'platform' => $_platform,
				'cat'      => $_cat,
				'key'      => $_key,
				'value'    => $_value,
			];

			return \lib\db\setting\insert::single_insert_fuel($insert, $_fuel, $_database);
		}
	}




}
?>