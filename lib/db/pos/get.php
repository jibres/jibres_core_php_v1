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


	public static function multi_id($_ids)
	{
		$query = "SELECT * FROM pos WHERE id IN ($_ids)";
		$result = \dash\db::get($query);
		return $result;
	}



	public static function default_pos()
	{
		$query = "SELECT * FROM pos WHERE pos.isdefault = 1 LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}

?>