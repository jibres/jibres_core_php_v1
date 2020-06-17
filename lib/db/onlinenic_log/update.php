<?php
namespace lib\db\onlinenic_log;


class update
{

	public static function send($_send,$_log_id)
	{
		$_send = addslashes($_send);
		$query  = "UPDATE log SET log.send = '$_send' WHERE log.id = $_log_id LIMIT 1";
		$result = \dash\db::query($query, 'onlinenic_log');
		return $result;
	}

	public static function update($_args, $_log_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE log SET $set WHERE log.id = $_log_id LIMIT 1";
		$result = \dash\db::query($query, 'onlinenic_log');
		return $result;
	}
}
?>