<?php
namespace lib\db\setting;


class delete
{

	public static function record($_id)
	{
		$query  = "DELETE FROM setting WHERE setting.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function by_cat_key($_cat, $_key)
	{
		$query = "DELETE FROM setting WHERE setting.cat = '$_cat' AND setting.key = '$_key' LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function by_cat_key_value($_cat, $_key, $_value)
	{
		$query = "DELETE FROM setting WHERE setting.cat = '$_cat' AND setting.key = '$_key' AND setting.value = '$_value' LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>
