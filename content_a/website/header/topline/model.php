<?php
namespace content_a\website\header\topline;

class model
{
	public static function post()
	{
		$post =
		[
			'text'   => \dash\request::post('text'),
			'url'    => \dash\request::post('url'),
			'target' => \dash\request::post('target'),
		];

		$customize_header = \lib\app\website\header\topline::set($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
