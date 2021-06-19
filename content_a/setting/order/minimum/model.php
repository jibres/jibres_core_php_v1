<?php
namespace content_a\setting\order\minimum;


class model
{
	public static function post()
	{
		$post               = [];
		$post['minimumorderamount'] = \dash\request::post('minimumorderamount');

		\lib\app\setting\set::cart_setting($post);

		\dash\redirect::pwd();
	}
}
?>