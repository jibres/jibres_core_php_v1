<?php
namespace content_a\setting\whatsapp;


class model
{
	public static function post()
	{


		$post =
		[
			'whatsapp'  => \dash\request::post('whatsapp'),

		];


		\lib\app\store\edit::social($post);


		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
		}
	}
}
?>