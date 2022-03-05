<?php
namespace dash\db\telegrams;


class update
{
	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('telegrams', $_args, $_id);
	}


	public static function record_api_log($_args, $_id)
	{
		return \dash\pdo\query_template::update('telegram', $_args, $_id, 'api_log');
	}






	/**
	 * Set sending the list
	 */
	public static function set_sending_list($_ids)
	{
		$query  = "UPDATE  telegram_sending SET telegram_sending.status = 'sending' WHERE telegram_sending.id IN ($_ids)";
		$param = [];
		$result = \dash\pdo::query($query, $param, 'api_log');
		return $result;
	}
}
?>