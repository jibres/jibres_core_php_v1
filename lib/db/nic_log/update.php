<?php
namespace lib\db\nic_log;


class update
{

	public static function send($_send,$_log_id)
	{
		$_send = addslashes($_send);
		$query  = "UPDATE log SET log.send = '$_send' WHERE log.id = $_log_id LIMIT 1";
		$result = \dash\db::query($query, 'nic_log');
		return $result;
	}
}
?>