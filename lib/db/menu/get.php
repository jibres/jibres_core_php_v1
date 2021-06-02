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


	public static function master_by_id($_id)
	{
		$query = "SELECT * FROM menu WHERE menu.id = $_id AND menu.parent1 IS NULL AND menu.parent2 IS NULL AND menu.parent3 IS NULL AND menu.parent4 IS NULL AND menu.parent5 IS NULL LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function child_by_master_id($_master_id, $_id)
	{
		$query = "SELECT * FROM menu WHERE menu.id = $_id AND menu.parent1 = $_master_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function get_used_social($_social_network)
	{
		$query = "SELECT * FROM menu WHERE menu.pointer = 'socialnetwork' AND menu.socialnetwork = '$_social_network' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function get_used($_pointer, $_related_id)
	{
		$query = "SELECT * FROM menu WHERE menu.pointer = '$_pointer' AND menu.related_id = $_related_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function load_menu($_id, $_max_level)
	{
		$other = null;
		if($_max_level == 1)
		{
			$other = ' AND menu.parent2 IS NULL AND menu.parent3 IS NULL AND menu.parent4 IS NULL AND menu.parent5 IS NULL ';
		}
		elseif($_max_level == 2)
		{
			$other = ' AND menu.parent3 IS NULL AND menu.parent4 IS NULL AND menu.parent5 IS NULL ';
		}
		elseif($_max_level == 3)
		{
			$other = ' AND menu.parent4 IS NULL AND menu.parent5 IS NULL ';
		}
		elseif($_max_level == 4)
		{
			$other = ' AND menu.parent5 IS NULL ';
		}


		$query =
		"
			SELECT
				*
			FROM
				menu
			WHERE
				(
					menu.id      = $_id OR
					menu.parent1 = $_id
				)
				$other
			ORDER BY menu.sort ASC

		";

		$result = \dash\db::get($query);
		return $result;
	}

	public static function child_count($_id)
	{
		$query =
		"
			SELECT
				COUNT(*) AS `count`
			FROM
				menu
			WHERE
				menu.parent1 = $_id OR
				menu.parent2 = $_id OR
				menu.parent3 = $_id OR
				menu.parent4 = $_id OR
				menu.parent5 = $_id
		";
		$result = \dash\db::get($query, 'count', true);
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
				menu.parent1 = $_id OR
				menu.parent2 = $_id OR
				menu.parent3 = $_id OR
				menu.parent4 = $_id OR
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
