<?php
namespace content_a\website\header\template;

class model
{
	public static function post()
	{
		$post =
		[
			'header'    => \dash\request::post('header'),
		];

		$theme_detail = \lib\app\website\header\set::set_header_template($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that());
		}
	}
}
?>