<?php
namespace content_a\setting\thirdparty\torob;


class model
{
	public static function post()
	{
		$post =
		[
			'torob_api'    => \dash\request::post('torob_api'),
		];

		\lib\app\store\edit::selfedit($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>