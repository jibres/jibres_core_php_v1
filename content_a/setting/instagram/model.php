<?php
namespace content_a\setting\instagram;


class model
{
	public static function post()
	{


		$post =
		[

			'instagram'   => \dash\request::post('instagram'),

		];


		\lib\app\store\edit::social($post);


		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
		}
	}
}
?>