<?php
namespace lib\db\inventory;


class get
{

	public static function one($_id)
	{
		$query = "SELECT * FROM inventory WHERE id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function all()
	{
		$query = "SELECT * FROM inventory";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function check_duplicate($_title)
	{
		$query = "SELECT * FROM inventory WHERE inventory.name = '$_title' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function count_all()
	{
		$query = "SELECT COUNT(*) AS `count` FROM inventory ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}
}
?>