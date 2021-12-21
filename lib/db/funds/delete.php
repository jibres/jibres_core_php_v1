<?php
namespace lib\db\funds;


class delete
{
	public static function record($_id)
	{
		$query = "DELETE FROM funds WHERE funds.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, []);
		return $result;
	}
}
?>