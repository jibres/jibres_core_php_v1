<?php
namespace content_love\sms\sending;


class model
{
	public static function post()
	{
		if(\dash\request::post('run') === 'manually')
		{
			$result = \lib\app\sms\queue::send_real_time(true);
			\dash\notif::ok(T_("Request was sended"));
		}

	}
}
?>
