<?php
namespace content_a\setting\product\preparationtime;


class model
{
	public static function post()
	{
		$post           = [];

		$post['preparationtime'] = \dash\request::post('preparationtime');


		\lib\app\setting\set::product_setting($post);

		\dash\redirect::pwd();
	}
}
?>