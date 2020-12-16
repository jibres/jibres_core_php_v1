<?php
namespace dash\db;


class files
{

	public static function insert($_args)
	{
		\dash\db\config::public_insert('files', $_args);
		return \dash\db::insert_id();
	}



	public static function attachment_count()
	{
		$query = "SELECT COUNT(*) AS 'count' FROM files ";
		$count = \dash\db::get($query,'count', true);
		return $count;
	}

	/**
	 * check duplocate MD5 of file in database
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function duplicate($_md5)
	{
		$query = "SELECT * FROM files WHERE files.md5 = '$_md5' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function get_by_ids($_ids)
	{
		$query = "SELECT * FROM files WHERE files.id IN ($_ids) ";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function by_id($_id)
	{
		$query = "SELECT * FROM files WHERE files.id = $_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function set_removed($_id)
	{
		$query = "UPDATE files SET files.status = 'removed' WHERE files.id = $_id LIMIT 1 ";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM files $q[join] $q[where]  ";

		$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit']);

		$query = " SELECT files.* FROM 	files $q[join] $q[where] $q[order] $limit ";
		$result = \dash\db::get($query);

		return $result;
	}

	public static function search()
	{

		$result = \dash\db\config::public_search('files', ...func_get_args());
		return $result;
	}

	public static function get()
	{
		$result = \dash\db\config::public_get('files', ...func_get_args());
		return $result;
	}
}
?>