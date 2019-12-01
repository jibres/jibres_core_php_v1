<?php
namespace content_a\setting\general;


class model
{
	public static function post()
	{
		\lib\app\store\edit::selfedit(self::getPost());

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}


	public static function getPost()
	{
		$args =
		[
			'title'    => \dash\request::post('title'),
			'desc'    => \dash\request::post('desc'),
		];
		return $args;
	}
}
?>