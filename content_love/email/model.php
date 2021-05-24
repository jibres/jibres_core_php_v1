<?php
namespace content_love\email;


class model
{
	public static function post()
	{
		$to = \dash\request::post('to');

		// $send = \lib\email\send::test($to);

		\dash\notif::debug('salam');
		// \dash\notif::info($send);

		// \dash\code::jsonBoom($send);
	}
}
?>