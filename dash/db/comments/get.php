<?php
namespace dash\db\comments;


class get
{
	public static function by_id($_id)
	{
		$query  = "SELECT * FROM comments WHERE comments.id = $_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>