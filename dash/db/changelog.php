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


	public static function insert($_args)
	{
		return \dash\pdo\query_template::insert('changelog', $_args);
	}



	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('changelog', $_args, $_id);
	}


	public static function delete($_id)
	{
		$query = "DELETE FROM changelog WHERE changelog.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
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
