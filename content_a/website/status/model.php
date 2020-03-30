<?php
namespace content_a\website\status;

class model
{
	public static function post()
	{
		$post =
		[
			'status'    => \dash\request::post('status'),
		];

		$theme_detail = \lib\app\website_status\set::status($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
