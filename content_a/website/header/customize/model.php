<?php
namespace content_a\website\header\customize;

class model
{
	public static function post()
	{
		$post =
		[
			'description' => \dash\request::post('description'),
			'menu'        => \dash\request::post('menu'),
		];

		$customize_header = \lib\app\website_header\set::customize_header($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
