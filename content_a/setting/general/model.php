<?php
namespace content_a\setting\general;


class model
{
	public static function post()
	{
		\lib\app\store::edit(self::getPost());

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}


	public static function getPost()
	{
		$args =
		[
			'name'    => \dash\request::post('name'),
			'website' => \dash\request::post('website'),
			'desc'    => \dash\request::post('desc'),
			'status'  => \dash\request::post('status'),
		];
		return $args;
	}
}
?>