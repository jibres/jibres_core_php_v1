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



	public static function record($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'update']);
		if($set)
		{
			$query = " UPDATE `sms_log` SET $set WHERE sms_log.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
		else
		{
			return false;
		}
	}




}
?>
