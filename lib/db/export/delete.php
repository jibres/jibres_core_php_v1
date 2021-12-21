<?php
namespace lib\db\export;


class delete
{

	public static function delete($_id)
	{
		$query = "DELETE FROM importexport  WHERE importexport.id = $_id  LIMIT 1";
		$result = \dash\pdo::query($query, []);
		return $result;
	}
}
?>