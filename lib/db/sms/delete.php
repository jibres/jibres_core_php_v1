<?php
namespace lib\db\sms;


class delete
{

	/**
	 * Delete sending list
	 */
	public static function sending_by_multi_id($_ids)
	{
		$query  = "DELETE FROM sms_sending WHERE sms_sending.id IN ($_ids)";
		$result = \dash\pdo::query($query, [], 'api_log');
		return $result;
	}


}
?>
