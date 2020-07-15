<?php
namespace content_a\setting\product\viewtext;


class model
{
	public static function post()
	{
		$post           = [];
		$post['view_text'] = \dash\request::post('view_text');

		\lib\app\setting\set::product_setting($post);

		\dash\redirect::pwd();
	}
}
?>