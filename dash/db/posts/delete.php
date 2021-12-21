<?php
namespace dash\db\posts;


class delete
{

	public static function record($_id)
	{
		$query  = "DELETE FROM posts WHERE posts.id = $_id ";
		$result = \dash\pdo::query($query, []);
		return $result;
	}


}
?>
