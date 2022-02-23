<?php
namespace lib\db\sms;


class update
{



	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('sms', $_args, $_id, 'api_log');
	}


	/**
	 * Set sending the list
	 */
	public static function set_sending_list($_ids)
	{
		$query  = "UPDATE  sms_sending SET sms_sending.status = 'sending', sms_sending.datemodified = :mydate WHERE sms_sending.id IN ($_ids)";
		$param = [':mydate' => date("Y-m-d H:i:s")];
		$result = \dash\pdo::query($query, $param, 'api_log');
		return $result;
	}


}
?>
