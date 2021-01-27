<?php
namespace content_crm\sms\conversation;


class controller
{
	public static function routing()
	{
		\dash\permission::access('crmSms');
	}
}
?>
