<?php
namespace content_my\ipg\setup\iban;


class model
{
	public static function post()
	{
		$post =
		[
			'iban' => \dash\request::post('iban'),
			'card'  => \dash\request::post('card'),
		];

		\lib\app\ipg\iban\set::user_default_iban($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). '/gateway');
		}
	}
}
?>