<?php
namespace content_my\ipg\iban;


class model
{
	public static function post()
	{
		$post =
		[
			'iban' => \dash\request::post('iban'),
			'card'  => \dash\request::post('card'),
		];

		\lib\app\shaparak\iban\set::user_default_iban($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>