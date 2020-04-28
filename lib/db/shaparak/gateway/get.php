<?php
namespace lib\db\shaparak\gateway;


class get
{
	public static function my_first_gateway($_user_id)
	{
		$query  = "SELECT *  FROM gateway WHERE gateway.user_id = $_user_id ORDER BY gateway.id ASC LIMIT 1";
		$result = \dash\db::get($query, null, true, 'shaparak');
		return $result;
	}


}
?>