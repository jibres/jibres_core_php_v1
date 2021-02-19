<?php
namespace content_a\setting\branding;


class model
{
	public static function post()
	{
		$post =
		[
			'plan'  => \dash\request::post('key'),
		];

		\lib\app\plan\branding::remove($post);

		\dash\redirect::pwd();

	}
}
?>