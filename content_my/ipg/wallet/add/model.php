<?php
namespace content_my\ipg\wallet\add;


class model
{
	public static function post()
	{
		$post =
		[
			'title' => \dash\request::post('title'),
		];

		\lib\app\shaparak\wallet\set::add_new_wallet($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that());
		}
	}
}
?>