<?php
namespace content_my\ipg\setup\gateway;


class model
{
	public static function post()
	{
		$post =
		[
			'title'      => \dash\request::post('title'),
			'websiteAddress' => \dash\request::post('websiteurl'),
			'emailAddress'      => \dash\request::post('email'),
			'telephoneNumber'      => \dash\request::post('phone'),
		];

		\lib\app\shaparak\shop\set::first_shop($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>