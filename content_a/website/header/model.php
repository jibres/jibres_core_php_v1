<?php
namespace content_a\website\header;

class model
{
	public static function post()
	{
		$post =
		[
			'header'    => \dash\request::post('header'),
		];

		$theme_detail = \lib\app\website_header\set::set_header_template($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/header/customize');
		}
	}
}
?>
