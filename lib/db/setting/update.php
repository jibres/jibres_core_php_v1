<?php
namespace lib\db\setting;


class update
{


	public static function by_cat_key($_cat, $_key, $_value)
	{
		$query = "UPDATE setting SET setting.value = '$_value'  WHERE setting.cat = '$_cat' AND setting.key = '$_key' LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function key($_key, $_id)
	{
		$query = "UPDATE setting SET setting.key = '$_key'  WHERE setting.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}



	public static function value($_value, $_id)
	{
		$query = "UPDATE setting SET setting.value = '$_value'  WHERE setting.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function overwirte_platform_cat_key($_value, $_platform, $_cat, $_key)
	{
		$query = "SELECT setting.id, setting.value FROM setting WHERE setting.platform = '$_platform' AND setting.cat = '$_cat' AND setting.key = '$_key' LIMIT 1";
		$check = \dash\db::get($query, null, true);

		if(isset($check['id']))
		{
			if(isset($check['value']) && $check['value'] === $_value)
			{
				return null;
			}
			else
			{
				$query = "UPDATE setting SET setting.value = '$_value'  WHERE setting.id = $check[id] LIMIT 1";
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
		$query = "SELECT setting.id, setting.value FROM setting WHERE setting.lang = '$_lang' AND setting.platform = '$_platform' AND setting.cat = '$_cat' AND setting.key = '$_key' LIMIT 1";
		$check = \dash\db::get($query, null, true);

		if(isset($check['id']))
		{
			if(isset($check['value']) && $check['value'] === $_value)
			{
				return null;
			}
			else
			{
				$query = "UPDATE setting SET setting.value = '$_value'  WHERE setting.id = $check[id] LIMIT 1";
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
		$query = "SELECT setting.id, setting.value FROM setting WHERE setting.cat = '$_cat' AND setting.key = '$_key' LIMIT 1";
		$check = \dash\db::get($query, null, true);

		if(isset($check['id']))
		{
			if(isset($check['value']) && $check['value'] === $_value)
			{
				return null;
			}
			else
			{
				$query = "UPDATE setting SET setting.value = '$_value'  WHERE setting.id = $check[id] LIMIT 1";
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



	public static function overwirte_platform_cat_key_fuel($_value, $_platform, $_cat, $_key, $_fuel, $_database)
	{
		$query = "SELECT setting.id AS `id` FROM setting WHERE setting.platform = '$_platform' AND setting.cat = '$_cat' AND setting.key = '$_key' LIMIT 1";
		$check = \dash\db::get($query, 'id', true, $_fuel, ['database' => $_database]);
		if($check)
		{
			$query = "UPDATE setting SET setting.value = '$_value'  WHERE setting.id = $check LIMIT 1";
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

			return \lib\db\setting\insert::insert_fuel($insert, $_fuel, $_database);
		}
	}




}
?>