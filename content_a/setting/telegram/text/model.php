<?php
namespace content_a\setting\telegram\text;


class model
{
	public static function post()
	{
		$post           = [];
		$post['share_text'] = \dash\request::post('share_text');

		\lib\app\setting\set::telegram_setting($post);

		\dash\redirect::pwd();
	}
}
?>