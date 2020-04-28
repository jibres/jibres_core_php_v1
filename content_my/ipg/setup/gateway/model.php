<?php
namespace content_my\ipg\setup\gateway;


class model
{
	public static function post()
	{
		$post =
		[
			'title'      => \dash\request::post('title'),
			'websiteurl' => \dash\request::post('websiteurl'),
			'email'      => \dash\request::post('email'),
			'phone'      => \dash\request::post('phone'),
		];

		\lib\app\ipg\gateway\set::first_gateway($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>