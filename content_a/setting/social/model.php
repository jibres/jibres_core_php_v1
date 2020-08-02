<?php
namespace content_a\setting\social;


class model
{
	public static function post()
	{
		$post =
		[
			'instagram' => \dash\request::post('instagram'),
			'telegram'  => \dash\request::post('telegram'),
			'youtube'   => \dash\request::post('youtube'),
			'twitter'   => \dash\request::post('twitter'),
			'linkedin'  => \dash\request::post('linkedin'),
			'github'    => \dash\request::post('github'),
			'facebook'  => \dash\request::post('facebook'),
			'email'     => \dash\request::post('email'),
			'aparat'    => \dash\request::post('aparat'),
			'eitaa'     => \dash\request::post('eitaa'),
		];


		\lib\app\store\edit::social($post);

		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
			\dash\redirect::pwd();
		}
	}


}
?>