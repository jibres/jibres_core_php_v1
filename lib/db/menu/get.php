<?php
namespace lib\db\menu;


class get
{

	public static function by_id($_id)
	{
		$query = "SELECT * FROM menu WHERE menu.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function child($_id)
	{
		$query =
		"
			SELECT
				*
			FROM
				menu
			WHERE
				menu.parent1 = $_id ||
				menu.parent2 = $_id ||
				menu.parent3 = $_id ||
				menu.parent4 = $_id ||
				menu.parent5 = $_id
			ORDER BY
				menu.sort ASC
		";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function list_all_menu()
	{
		$query = "SELECT menu.*, (SELECT COUNT(*) FROM menu AS `cmenu` WHERE cmenu.parent1 = menu.id ) as `count_link` FROM menu WHERE menu.parent1 IS NULL LIMIT 500";
		$result = \dash\db::get($query);
		return $result;
	}

}
?>
