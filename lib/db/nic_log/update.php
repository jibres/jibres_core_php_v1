<?php
namespace lib\db\nic_log;


class update
{

	public static function send($_send,$_log_id)
	{
		$_send = addslashes($_send);
		$query  = "UPDATE log SET log.send = '$_send' WHERE log.id = $_log_id LIMIT 1";
		$result = \dash\pdo::query($query, [], 'nic_log');
		return $result;
	}

	public static function update($_args, $_log_id)
	{
		return \dash\pdo\query_template::update('log', $_args, $_id, 'nic_log');
	}
}
?>