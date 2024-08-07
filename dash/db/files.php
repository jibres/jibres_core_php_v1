<?php
namespace dash\db;

/**
 * This class describes an files.
 *
 * @author Reza
 *
 * All functions in this class became query bind PDO
 * @date 2021-12-27 15:32:22
 *
 */
class files
{

	public static function insert($_args)
	{
		return \dash\pdo\query_template::insert('files', $_args);
	}


	public static function get_usages($_id)
	{
		$query  = "SELECT fileusage.* FROM fileusage WHERE fileusage.file_id = :id ";
		$param  = [':id' => $_id];
		$result = \dash\pdo::get($query, $param);
		return $result;
	}

	public static function count_all()
	{
		$query = "SELECT COUNT(*) AS `count` FROM files ";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}

	public static function total_size()
	{
		$query = "SELECT SUM(files.totalsize) AS `sum` FROM files ";
		$result = \dash\pdo::get($query, [], 'sum', true);
		return $result;
	}



	public static function get_usages_count($_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM fileusage WHERE fileusage.file_id = :id ";
		$param  = [':id' => $_id];
		$result = \dash\pdo::get($query, $param, 'count', true);
		return $result;
	}


	public static function set_unknown_fileusage($_relate, $_user_id, $_relate_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM fileusage WHERE fileusage.user_id = :user_id AND  fileusage.related = :relate AND fileusage.related_id IS NULL";
		$param =
		[
			':user_id' => $_user_id,
			':relate'  => $_relate,
		];

		$count = \dash\pdo::get($query, $param, 'count', true);

		if($count && is_numeric($count))
		{
			$query = "UPDATE fileusage SET fileusage.related_id = $_relate_id WHERE fileusage.user_id = :user_id AND  fileusage.related = :relate AND fileusage.related_id IS NULL LIMIT $count";

			$result = \dash\pdo::get($query, $param);

			return $result;
		}
		return false;
	}

	public static function remove($_id)
	{
		$param  = [':id' => $_id];

		$query  = "DELETE FROM fileusage WHERE fileusage.file_id = :id ";
		$result = \dash\pdo::get($query, $param);

		$query  = "DELETE FROM files WHERE files.id = :id LIMIT 1";
		$result = \dash\pdo::get($query, $param);

		return $result;
	}


	public static function attachment_count()
	{
		$query = "SELECT COUNT(*) AS 'count' FROM files ";
		$count = \dash\pdo::get($query, [],'count', true);
		return $count;
	}

	/**
	 * check duplocate MD5 of file in database
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function duplicate($_md5)
	{
		$query = "SELECT * FROM files WHERE files.md5 = :md5 LIMIT 1";
		$param  = [':md5' => $_md5];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}



	public static function by_id($_id)
	{
		$query  = "SELECT * FROM files WHERE files.id = :id LIMIT 1 ";
		$param  = [':id' => $_id];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}



	public static function set_removed($_id)
	{
		$query = "UPDATE files SET files.status = 'removed' WHERE files.id = :id LIMIT 1 ";
		$param  = [':id' => $_id];
		$result = \dash\pdo::query($query, $param);
		return $result;
	}


	public static function list($_param, $_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\pdo\prepare_query::binded_ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM files $q[join] $q[where]  ";

		$limit = \dash\db\pagination::pagination_query($pagination_query, $_param, $q['limit']);

		$query = " SELECT files.* FROM 	files $q[join] $q[where] $q[order] $limit ";
		$result = \dash\pdo::get($query, $_param);

		return $result;
	}




	public static function chart_count_size_per_type()
	{
		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				SUM(files.totalsize) AS `size`,
				files.type
			FROM files
				GROUP BY files.type
		";

		$result = \dash\pdo::get($query);
		return $result;
	}
}
?>