<?php
namespace content_a\setting\cart\limit;


class model
{
	public static function post()
	{
		$post               = [];
		$post['maxproductincart'] = \dash\request::post('maxproductincart');

		\lib\app\setting\set::cart_setting($post);

		\dash\redirect::pwd();
	}
}
?>