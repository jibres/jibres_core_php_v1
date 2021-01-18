<?php
namespace dash\db\telegrams;


class get
{
	public static function by_id($_id)
	{
		$query  = "SELECT * FROM telegrams WHERE telegrams.id = $_id  LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>