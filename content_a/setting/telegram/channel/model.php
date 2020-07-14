<?php
namespace content_a\setting\telegram\channel;


class model
{
	public static function post()
	{
		$post           = [];
		$post['channel'] = \dash\request::post('channel');

		\lib\app\setting\set::telegram_setting($post);

		\dash\redirect::pwd();
	}
}
?>