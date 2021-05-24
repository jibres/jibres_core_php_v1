<?php
namespace content_love\email;


class model
{
	public static function post()
	{
		$to = \dash\request::get('to');

		$send = \lib\email\send::test($to);

		var_dump($to);
		var_dump($send);
		exit();
		\dash\code::jsonBoom($send);
	}
}
?>