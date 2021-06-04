<?php
namespace content_love\email;


class model
{
	public static function post()
	{
		// get to
		$to = \dash\request::post('to');

		// try to send
		$sendLog = \dash\email\template::verify(true, $to, 'Javad Adib', 'https://jibres.ir/about');

		// show result
		\dash\notif::debug($sendLog);
	}
}
?>