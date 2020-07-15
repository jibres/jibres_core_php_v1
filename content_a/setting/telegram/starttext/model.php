<?php
namespace content_a\setting\telegram\starttext;


class model
{
	public static function post()
	{
		$post           = [];
		$post['start_text'] = \dash\request::post('start_text');

		\lib\app\setting\set::telegram_setting($post);

		\dash\redirect::pwd();
	}
}
?>