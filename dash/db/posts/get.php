<?php
namespace dash\db\posts;


class get
{
	public static function check_duplicate_url_in_posts($_url, $_id = null)
	{
		$check_id = null;
		if($_id)
		{
			$check_id = " AND posts.id != $_id ";
		}

		$query  = "SELECT * FROM posts WHERE posts.url = '$_url' $check_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function list_all_of_pages($_current_id)
	{
		$query  = "SELECT posts.id, posts.title, posts.parent FROM posts WHERE posts.type = 'page' AND posts.id != $_current_id ";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function by_id($_id)
	{
		$query  = "SELECT * FROM posts WHERE posts.id = $_id  LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function check_duplicate($_slug, $_language)
	{
		$query  = "SELECT * FROM posts WHERE posts.slug = '$_slug' AND posts.language = '$_language' LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function get_one($_args)
	{
		$where  = \dash\db\config::make_where($_args);
		$query  = "SELECT * FROM posts WHERE $where LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

}
?>