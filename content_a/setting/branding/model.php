<?php
namespace content_a\setting\branding;


class model
{
	public static function post()
	{


		$post =
		[
			'linkedin'  => \dash\request::post('linkedin'),

			// 'instagram' => \dash\request::post('instagram'),
			// 'telegram'  => \dash\request::post('telegram'),
			// 'youtube'   => \dash\request::post('youtube'),
			// 'github'    => \dash\request::post('github'),
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