<?php
namespace content_a\setting\domain;


class model
{
	public static function post()
	{
		$post =
		[
			'domain' => \dash\request::post('domain'),
		];

		$result = \lib\app\business_domain\add::store_add($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}


}
?>