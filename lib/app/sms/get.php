<?php
namespace lib\app\sms;


class get
{
	public static function get($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}


		$load = \lib\db\sms_log\get::by_id($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Log not founded"));
			return false;
		}

		$load = \lib\app\sms\ready::row($load);

		return $load;
	}


	public static function jibres_sms_get($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}


		$load = \lib\db\sms\get::by_id($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Log not founded"));
			return false;
		}

		$load = \lib\app\sms\ready::row($load);

		return $load;
	}


    /**
     * @return float
     */
    public static function notSentSMSCount() : float
    {
        $count = \lib\db\sms_log\get::notSentSMSCount();
        return floatval($count);
    }
}
?>