<?php
namespace lib\db\nic_poll;


class update
{
	public static function update($_args, $_poll_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE poll SET $set WHERE poll.id = $_poll_id LIMIT 1";
		$result = \dash\db::query($query, 'nic');
		return $result;
	}
}
?>