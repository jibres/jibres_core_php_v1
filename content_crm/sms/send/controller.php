<?php
namespace content_crm\sms\send;


class controller
{
	public static function routing()
	{
		\dash\permission::access('crmSms');

		if(\dash\url::isLocal())
		{
			// nothing
		}
		else
		{
			\dash\redirect::to(\dash\url::this(). '/datalist');
		}
	}
}
?>
