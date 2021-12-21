<?php
namespace dash\db\terms;


class delete
{

	public static function record($_id)
	{
		$query  = "DELETE FROM terms WHERE terms.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, []);
		return $result;
	}

}
?>
