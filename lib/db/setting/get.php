<?php
namespace lib\db\setting;


class get
{

	public static function by_cat_key($_cat, $_key)
	{
		$query = "SELECT * FROM setting WHERE setting.cat = '$_cat' AND setting.key = '$_key' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function by_cat($_cat)
	{
		$query = "SELECT * FROM setting WHERE setting.cat = '$_cat'";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>