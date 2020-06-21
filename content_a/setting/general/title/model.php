<?php
namespace content_a\setting\general\title;


class model
{
	public static function post()
	{
		$post =
		[
			'desc'    => \dash\request::post('desc'),
		];

		\lib\app\store\edit::selfedit($post);

		\lib\app\store\edit::title(\dash\request::post('title'));

		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
			\dash\redirect::pwd();
		}
	}


}
?>