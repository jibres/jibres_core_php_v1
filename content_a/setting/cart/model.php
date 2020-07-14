<?php
namespace content_a\setting\cart;


class model
{
	public static function post()
	{
		$post           = [];
		$post['share_text'] = \dash\request::post('share_text');

		\lib\app\setting\set::cart_setting($post);

		\dash\redirect::pwd();
	}
}
?>