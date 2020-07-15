<?php
namespace content_a\setting\order\validity;


class model
{
	public static function post()
	{
		$post               = [];
		$post['life_time'] = \dash\request::post('life_time');

		\lib\app\setting\set::order_setting($post);

		\dash\redirect::pwd();
	}
}
?>