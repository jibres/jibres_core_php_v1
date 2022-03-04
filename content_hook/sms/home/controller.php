<?php
namespace content_hook\sms\home;

class controller
{
	public static function routing()
	{

		if(\dash\url::child() === '0690227dfb777e43dd557432b5ed0a41')
		{
			// 100020009

			\dash\log::set('smsHook1', ['my_data' => \dash\request::request()]);

			\dash\code::jsonBoom('Hi Hook! 2009');
		}
		elseif(\dash\url::child() === '73d2a4b18b8fa54f89ec1c64bcfc752c')
		{
			// 10002216
			\dash\log::set('smsHook2', ['my_data' => \dash\request::request()]);

			\dash\code::jsonBoom('Hi Hook! 2216');
		}
		else
		{
			\dash\header::status(404, ':/');
		}
	}
}
?>