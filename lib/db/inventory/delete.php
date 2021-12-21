<?php
namespace lib\db\inventory;


class delete
{
	public static function record($_id)
	{
		$query = "DELETE FROM inventory WHERE inventory.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, []);
		return $result;
	}
}
?>