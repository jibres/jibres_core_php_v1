<?php
namespace content_a\setting\telegram\text;


class model
{
	public static function post()
	{
		$post           = [];
		$post['text'] = \dash\request::post('text');

		\lib\app\setting\set::telegram_setting($post);

		\dash\redirect::pwd();
	}
}
?>