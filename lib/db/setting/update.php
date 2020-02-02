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


	public static function by_cat_key_value($_cat, $_key, $_value, $_json)
	{
		$query = "UPDATE setting SET setting.json = '$_json'  WHERE setting.cat = '$_cat' AND setting.key = '$_key' AND setting.value = '$_value' LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>