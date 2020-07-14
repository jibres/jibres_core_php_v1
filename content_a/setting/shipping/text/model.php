<?php
namespace content_a\setting\shipping\text;


class model
{
	public static function post()
	{
		$post               = [];
		$post['share_text'] = \dash\request::post('share_text');
		$post['color']      = \dash\request::post('color') ? \dash\request::post('color') : null;

		\lib\app\setting\set::shipping_setting($post);

		\dash\redirect::pwd();
	}
}
?>