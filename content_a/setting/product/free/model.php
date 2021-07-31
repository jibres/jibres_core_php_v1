<?php
namespace content_a\setting\product\free;


class model
{
	public static function post()
	{
		$post                 = [];

		$post['free_button_title'] = \dash\request::post('free_button_title');
		$post['free_button_link']  = \dash\request::post('free_button_link');

		\lib\app\setting\set::product_setting($post);

		\dash\redirect::pwd();
	}
}
?>