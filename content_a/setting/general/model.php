<?php
namespace content_a\setting\general;


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
			\dash\redirect::pwd();
		}
	}


}
?>