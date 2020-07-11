<?php
namespace lib\db\productinventory;


class get
{

	public static function one($_id)
	{
		$query = "SELECT * FROM productinventory WHERE id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function all()
	{
		$query = "SELECT * FROM productinventory";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function check_duplicate($_title)
	{
		$query = "SELECT * FROM productinventory WHERE productinventory.name = '$_title' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function count_all()
	{
		$query = "SELECT COUNT(*) AS `count` FROM productinventory ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}
}
?>