<?php
namespace content_crm\member\business;


class model
{

	public static function post()
	{

		$post =
		[
			'businesscount'           => \dash\request::post('businesscount'),
		];


		\dash\app\user\business::set($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>