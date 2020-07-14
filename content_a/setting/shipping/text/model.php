<?php
namespace content_a\setting\shipping\text;


class model
{
	public static function post()
	{
		$post               = [];
		$post['page_text'] = \dash\request::post('page_text');
		$post['color']      = \dash\request::post('color') ? \dash\request::post('color') : null;

		\lib\app\setting\set::shipping_setting($post);

		\dash\redirect::pwd();
	}
}
?>