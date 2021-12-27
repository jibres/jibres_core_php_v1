<?php
namespace dash\db;

/** work with posts **/
class posts
{
	public static function pdo_get_by_id_lock($_id)
	{
		$query = "SELECT * FROM posts WHERE posts.id = :id LIMIT 1 FOR UPDATE";
		$param = [':id' => $_id];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}

	public static function pdo_update($_args, $_id)
	{
		return \dash\pdo\query_template::update('posts', $_args, $_id);
	}



	public static function get_count()
	{
		return \dash\pdo\query_template::get_count('posts', ...func_get_args());
	}


	public static function get_active_count()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM posts WHERE posts.status != 'deleted' AND posts.type IN ('post', 'page') ";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}

	public static function avg_seorank()
	{
		$query  = "SELECT AVG(posts.seorank) AS `rank` FROM posts WHERE posts.status = 'publish' AND posts.type IN ('post', 'page') ";
		$result = \dash\pdo::get($query, [], 'rank', true);
		return $result;
	}





	public static function get_active_count_subtype($_subtype)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM posts WHERE posts.status != 'deleted' AND posts.type IN ('post', 'page') AND posts.subtype = '$_subtype' ";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}


	public static function get_count_special_address()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM posts WHERE posts.status != 'deleted' AND posts.type IN ('post', 'page') AND posts.specialaddress != 'independence' ";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}

	public static function get_count_have_cover()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM posts WHERE posts.status != 'deleted' AND posts.type IN ('post', 'page') AND posts.cover IS NOT NULL ";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}

	public static function get_count_published()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM posts WHERE posts.status = 'publish' AND posts.type IN ('post', 'page') ";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}



	/**
	 * insert new recrod in posts table
	 * @param array $_args fields data
	 * @return mysql result
	 */
	public static function insert()
	{
		return \dash\pdo\query_template::insert('posts', ...func_get_args());
	}


	/**
	 * update field from posts table
	 * get fields and value to update
	 * @param array $_args fields data
	 * @param string || int $_id record id
	 * @return mysql result
	 */
	public static function update()
	{
		return \dash\pdo\query_template::update('posts', ...func_get_args());
	}


}
?>
