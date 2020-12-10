<?php
namespace dash\db\posts;


class get
{
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
}
?>