<?php
namespace content_a\setting\domain;


class model
{
	public static function post()
	{
		$post =
		[
			'domain' => \dash\request::post('domain'),
		];

		\lib\app\store\domain::set($post);

		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
			\dash\redirect::pwd();
		}
	}


}
?>