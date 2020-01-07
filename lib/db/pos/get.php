<?php
namespace lib\db\pos;


class get
{

	public static function all()
	{
		$query = "SELECT * FROM pos";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function by_id($_id)
	{
		$query = "SELECT * FROM pos WHERE id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}

?>