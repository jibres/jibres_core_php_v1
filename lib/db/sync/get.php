<?php
namespace lib\db\sync;


class get
{

	public static function count_all()
	{
		$query   = "SELECT COUNT(*) AS `count` FROM sync ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function by_cat_key($_cat, $_key)
	{
		$query = "SELECT * FROM sync WHERE sync.cat = '$_cat' AND sync.key = '$_key' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function by_cat($_cat)
	{
		$query = "SELECT * FROM sync WHERE sync.cat = '$_cat'";
		$result = \dash\pdo::get($query);
		return $result;
	}
}
?>