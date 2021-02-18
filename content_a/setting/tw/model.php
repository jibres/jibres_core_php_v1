<?php
namespace content_a\setting\tw;


class model
{
	public static function post()
	{


		$post =
		[
			'twitter'   => \dash\request::post('twitter'),

			// 'instagram' => \dash\request::post('instagram'),
			// 'telegram'  => \dash\request::post('telegram'),
			// 'youtube'   => \dash\request::post('youtube'),
			// 'linkedin'  => \dash\request::post('linkedin'),
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