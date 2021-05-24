<?php
namespace content_love\email;


class model
{
	public static function post()
	{
		// get to
		$to = \dash\request::post('to');

		// try to send
		$sendLog = \dash\mail::send($to);

		// show result
		\dash\notif::debug($sendLog);
	}
}
?>