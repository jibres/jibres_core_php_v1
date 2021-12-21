<?php
namespace dash\db\csrf;


class delete
{
	public static function clean()
	{
		$query     = "DELETE FROM csrf WHERE csrf.datemodified IS NOT NULL";
		$result    = \dash\pdo::query($query, []);

		$yesterday = date("Y-m-d H:i:s", strtotime('-1 days'));
		$query     = "DELETE FROM csrf WHERE csrf.datecreated < '$yesterday'";
		$result    = \dash\pdo::query($query, []);

		return $result;
	}

}
?>