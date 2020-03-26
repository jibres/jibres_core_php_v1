<?php
namespace content_a\website\header\customize;

class model
{
	public static function post()
	{
		$post =
		[
			'header_description' => \dash\request::post('header_description'),
			'header_menu_1'      => \dash\request::post('header_menu_1'),
			'header_menu_2'      => \dash\request::post('header_menu_2'),

		];

		$customize_header = \lib\app\website_header\set::customize_header($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
