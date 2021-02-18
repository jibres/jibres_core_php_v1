<?php
namespace content_a\setting\aparat;


class model
{
	public static function post()
	{


		$post =
		[

			'aparat'   => \dash\request::post('aparat'),

		];


		\lib\app\store\edit::social($post);


		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
		}
	}
}
?>