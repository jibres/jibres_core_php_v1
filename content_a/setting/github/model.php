<?php
namespace content_a\setting\github;


class model
{
	public static function post()
	{


		$post =
		[
			'github'    => \dash\request::post('github'),

			// 'instagram' => \dash\request::post('instagram'),
			// 'telegram'  => \dash\request::post('telegram'),
			// 'youtube'   => \dash\request::post('youtube'),
			// 'email'     => \dash\request::post('email'),
			// 'aparat'    => \dash\request::post('aparat'),
			// 'eitaa'     => \dash\request::post('eitaa'),
		];


		\lib\app\store\edit::social($post);


		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
		}
	}
}
?>