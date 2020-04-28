<?php
namespace content_my\ipg\setup\iban;


class model
{
	public static function post()
	{
		$post =
		[
			'merchantIban' => \dash\request::post('iban'),
		];

		\lib\app\shaparak\iban\set::user_default_iban($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). '/gateway');
		}
	}
}
?>