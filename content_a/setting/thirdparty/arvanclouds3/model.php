<?php
namespace content_a\setting\thirdparty\arvanclouds3;


class model
{
	public static function post()
	{
		$post =
		[
			'provider'  => 'arvancloud',
			'status'    => \dash\request::post('status'),
			'accesskey' => \dash\request::post('accesskey'),
			'secretkey' => \dash\request::post('secretkey'),
			'endpoint'  => \dash\request::post('endpoint'),
		];

		\lib\app\setting\set::upload_provider($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>