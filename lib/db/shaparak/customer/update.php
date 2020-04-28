<?php
namespace lib\db\shaparak\customer;

class update
{
	public static function update_user_id($_args, $_user_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE customer SET $set WHERE customer.user_id = $_user_id LIMIT 1";
		$result = \dash\db::query($query, 'shaparak');
		return $result;
	}

}
?>