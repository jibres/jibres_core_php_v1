<?php
namespace content_a\setting\social;


class model
{
	public static function post()
	{
		$post =
		[
			'instagram'    => \dash\request::post('instagram'),
			'telegram'    => \dash\request::post('telegram'),
			'youtube'    => \dash\request::post('youtube'),
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