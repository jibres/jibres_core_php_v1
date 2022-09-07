<?php
namespace lib\db\sms_log;

class get
{
	public static function moneylow_list()
	{
		$query  = "SELECT * FROM sms_log WHERE  sms_log.status = :status  LIMIT 200 ";
		$param  = [':status' => 'moneylow'];
		$result = \dash\pdo::get($query, $param);
        return $result;
	}

    /**
     * Get count not send sms in business database
     * @return array|false|mixed|null
     */
    public static function notSentSMSCount()
    {
        $query  = "SELECT COUNT(*) AS `count` FROM sms_log WHERE  sms_log.status = :status ";
        $param = [':status' => 'moneylow'];
        $result = \dash\pdo::get($query, $param, 'count', true);
        return $result;
    }



    public static function by_id($_id)
	{
		$query = "SELECT * FROM sms_log WHERE sms_log.id = $_id LIMIT 1 ";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function not_sended($_limit)
	{
		$query = "SELECT * FROM sms_log WHERE sms_log.status IN('pending', 'register') AND sms_log.jibres_sms_id IS NULL LIMIT $_limit ";
		$result = \dash\pdo::get($query);
		return $result;
	}



}
?>