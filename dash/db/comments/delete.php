<?php
namespace dash\db\comments;


class delete
{
	public static function full_by_id($_id)
	{
		// remove all child
		$query  = "DELETE  FROM comments WHERE comments.parent = $_id  ";
		$result = \dash\db::query($query);

		$query  = "DELETE  FROM comments WHERE comments.id = $_id  LIMIT 1";
		$result = \dash\db::query($query);

		return $result;
	}


	public static function quote($_id)
	{
		// remove all qoute
		$query  = "DELETE FROM comments WHERE comments.for = 'quote' AND comments.pagebuilder_id = $_id  ";
		$result = \dash\db::query($query);

		$query  = "UPDATE comments SET comments.pagebuilder_id = NULL WHERE comments.pagebuilder_id = $_id ";
		$result = \dash\db::query($query);

		return $result;
	}




}
?>