<?php
namespace dash\db\tickets;

class update
{

	public static function update($_args, $_id)
	{
		$set    = \dash\db\config::make_set($_args);
		$query  = "UPDATE tickets SET $set WHERE tickets.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function assing_to_user($_guest_id, $_user_id)
	{
		$query  = "UPDATE tickets SET tickets.user_id = $_user_id, tickets.guestid = NULL WHERE tickets.guestid = '$_guest_id' ";
		$result = \dash\db::query($query);
	}

}
?>