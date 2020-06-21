<?php
namespace content_a\setting\product\setting;


class model
{
	public static function post()
	{
		$post =
		[
			'default_pirce_list'    => \dash\request::post('defaultpricelist'),
		];

		\lib\app\setting\set::product_setting($post);
	}
}
?>