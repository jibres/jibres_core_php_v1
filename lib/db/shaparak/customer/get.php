<?php
namespace lib\db\shaparak\customer;


class get
{
	public static function my_detail($_user_id)
	{
		$query  = " SELECT *  FROM customer WHERE customer.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'shaparak');
		return $result;
	}


	public static function by_user_id($_user_id)
	{
		$query  = " SELECT *  FROM customer WHERE customer.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'shaparak');
		return $result;
	}


}
?>