<?php
namespace dash\db;


class changelog
{

	public static function list_changelog_tags()
	{
		$query = "SELECT changelog.tag1, changelog.tag2, changelog.tag3, changelog.tag4, changelog.tag5 FROM changelog ";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function get_by_id($_id)
	{
		$query = "SELECT * FROM changelog WHERE changelog.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function insert()
	{
		\dash\db\config::public_insert('changelog', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function update()
	{
		return \dash\db\config::public_update('changelog', ...func_get_args());
	}


	public static function delete()
	{
		return \dash\db\config::public_delete('changelog', ...func_get_args());
	}


	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		if($q['pagination'] === false)
		{
			if($q['limit'])
			{
				$limit = "LIMIT $q[limit] ";
			}
			else
			{
				$limit = "LIMIT 100 ";
			}
		}
		else
		{
			$pagination_query = "SELECT COUNT(*) AS `count` FROM changelog $q[join] $q[where]  ";
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);
		}


		$query =
		"
			SELECT
				changelog.*
			FROM
				changelog
			$q[join]
			$q[where]
			$q[order]
			$limit
		";
		$result = \dash\db::get($query);

		return $result;
	}

}
?>
