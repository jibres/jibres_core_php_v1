<?php
namespace content_a\setting\telegram\bot;


class model
{
	public static function post()
	{
		$post           = [];
		$post['apikey'] = \dash\request::post('apikey');

		\lib\app\setting\set::telegram_setting($post);

		\dash\redirect::pwd();
	}
}
?>