<?php
namespace lib\db\menu;


class delete
{

	public static function by_id($_id)
	{
		$query  = "DELETE FROM menu WHERE menu.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>