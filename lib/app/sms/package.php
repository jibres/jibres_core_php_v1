<?php
namespace lib\app\sms;

class package
{
	public static function check(&$_sms_detail)
	{
		if(!\dash\url::isLocal())
		{
			return true;
		}

		$_sms_detail['status'] = 'moneylow';

		return false;

	}

}
?>