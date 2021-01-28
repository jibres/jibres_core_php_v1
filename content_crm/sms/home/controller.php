<?php
namespace content_crm\sms\home;


class controller
{
	public static function routing()
	{
		\dash\permission::access('crmSms');
		\dash\redirect::to(\dash\url::this(). '/datalist');
	}
}
?>
