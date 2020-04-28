<?php
namespace lib\db\shaparak\acceptor;


class get
{
	public static function my_first_acceptor($_user_id)
	{
		$query  = "SELECT *  FROM acceptor WHERE acceptor.user_id = $_user_id ORDER BY acceptor.id ASC LIMIT 1";
		$result = \dash\db::get($query, null, true, 'shaparak');
		return $result;
	}


	public static function by_id($_id)
	{
		$query  = "SELECT *  FROM acceptor WHERE acceptor.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'shaparak');
		return $result;
	}


}
?>