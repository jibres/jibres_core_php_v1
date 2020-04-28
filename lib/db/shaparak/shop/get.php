<?php
namespace lib\db\shaparak\shop;


class get
{
	public static function my_first_shop($_user_id)
	{
		$query  = "SELECT *  FROM shop WHERE shop.user_id = $_user_id ORDER BY shop.id ASC LIMIT 1";
		$result = \dash\db::get($query, null, true, 'shaparak');
		return $result;
	}


}
?>