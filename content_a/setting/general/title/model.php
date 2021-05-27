<?php
namespace content_a\setting\general\title;


class model
{
	public static function post()
	{
		$post =
		[
			'desc'       => \dash\request::post('desc'),
			'title'      => \dash\request::post('title'),
			'shorttitle' => \dash\request::post('shorttitle'),
		];

		\lib\app\store\edit::selfedit($post);

		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
			\dash\redirect::pwd();
		}
	}


}
?>