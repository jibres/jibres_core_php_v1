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


	public static function value($_value, $_id)
	{
		$query = "UPDATE setting SET setting.value = '$_value'  WHERE setting.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


}
?>