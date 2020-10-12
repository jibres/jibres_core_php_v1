<?php
namespace lib\db\setting;


class set
{


	public static function platform_cat_key_value($_platform, $_cat, $_key, $_value)
	{
		$query = "INSERT INTO setting SET setting.platform = '$_platform', setting.cat = '$_cat', setting.key = '$_key', setting.value = '$_value' ";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function cat_key_value($_cat, $_key, $_value)
	{
		$query = "INSERT INTO setting SET setting.cat = '$_cat', setting.key = '$_key', setting.value = '$_value' ";
		$result = \dash\db::query($query);
		return $result;
	}


}
?>