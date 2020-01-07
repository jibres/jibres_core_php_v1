<?php
namespace lib\db\pos;


class delete
{
	public static function record($_id)
	{
		$query = "DELETE FROM pos WHERE pos.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>