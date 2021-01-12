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


	public static function remove_menu($_id)
	{
		$query  = "DELETE FROM menu WHERE menu.parent1 = $_id OR menu.parent2 = $_id OR menu.parent3 = $_id OR menu.parent4 = $_id OR menu.parent5 = $_id ";
		$result = \dash\db::query($query);

		$query  = "DELETE FROM menu WHERE menu.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}




}
?>