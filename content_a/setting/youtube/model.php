<?php
namespace content_a\setting\youtube;


class model
{
	public static function post()
	{


		$post =
		[

			'youtube'   => \dash\request::post('youtube'),

			// 'instagram' => \dash\request::post('instagram'),
			// 'telegram'  => \dash\request::post('telegram'),
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