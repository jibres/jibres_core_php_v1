<?php
namespace content_my\ipg\wallet;


class model
{
	public static function post()
	{
		$post =
		[
			'wallet' => \dash\request::post('wallet'),
			'card'  => \dash\request::post('card'),
		];

		\lib\app\shaparak\wallet\set::user_default_wallet($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>