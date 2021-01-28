<?php
namespace lib\db\sms_log;

class update
{

	public static function set_multi_sending($_ids)
	{
		$ids = implode(',', $_ids);
		$query = "UPDATE sms_log SET sms_log.status = 'sending' WHERE sms_log.id IN ($ids)";
		$result = \dash\db::query($query);
		return $result;
	}




}
?>