<?php
namespace content_a\home;


class model
{
	public static function post()
	{

		if(\dash\request::post('hide') === 'sms_notif')
		{
			\lib\app\setting\tools::update('admin_notification', 'sms_pack_alert_hide', date("Y-m-d H:i:s"));
			\dash\notif::complete();
		}
	}
}
?>