<?php
namespace lib\db\sms_log;

class update
{

	public static function archive_all_not_sended_query()
	{
		$query = "UPDATE sms_log SET sms_log.status = 'cancel' WHERE sms_log.status = 'moneylow' ";
		$result = \dash\pdo::query($query, []);
		return $result;
	}

	public static function set_multi_sending($_ids)
	{
		$ids = implode(',', $_ids);
		$query = "UPDATE sms_log SET sms_log.status = 'sending' WHERE sms_log.id IN ($ids)";
		$result = \dash\pdo::query($query, []);
		return $result;
	}



	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('sms_log', $_args, $_id);
	}




}
?>
