<?php
namespace content_a\setting\product\text;


class model
{
	public static function post()
	{
		$post           = [];
		$post['share_text'] = \dash\request::post('share_text');

		\lib\app\setting\set::product_setting($post);

		\dash\redirect::pwd();
	}
}
?>