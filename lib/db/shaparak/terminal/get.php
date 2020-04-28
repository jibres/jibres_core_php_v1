<?php
namespace lib\db\shaparak\terminal;


class get
{
	public static function my_first_terminal($_user_id)
	{
		$query  = "SELECT *  FROM terminal WHERE terminal.user_id = $_user_id ORDER BY terminal.id ASC LIMIT 1";
		$result = \dash\db::get($query, null, true, 'shaparak');
		return $result;
	}


	public static function by_id($_id)
	{
		$query  = "SELECT *  FROM terminal WHERE terminal.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'shaparak');
		return $result;
	}


}
?>