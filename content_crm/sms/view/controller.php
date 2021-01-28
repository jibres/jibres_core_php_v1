<?php
namespace content_crm\sms\view;


class controller
{
	public static function routing()
	{
		\dash\permission::access('crmSms');

		$id = \dash\request::get('id');
		$load = \lib\app\sms\get::get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);
	}
}
?>
