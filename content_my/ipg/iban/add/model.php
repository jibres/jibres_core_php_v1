<?php
namespace content_my\ipg\iban\add;


class model
{
	public static function post()
	{
		$post =
		[
			'title' => \dash\request::post('title'),
			'merchantIban'  => \dash\request::post('iban'),
		];

		\lib\app\shaparak\iban\set::add_new_iban($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that());
		}
	}
}
?>