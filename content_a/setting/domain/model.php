<?php
namespace content_a\setting\domain;


class model
{
	public static function post()
	{
		$post =
		[
			'domain1' => \dash\request::post('domain1'),
			'domain2' => \dash\request::post('domain2'),
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