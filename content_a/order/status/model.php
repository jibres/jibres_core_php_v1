<?php
namespace content_a\order\status;


class model
{

	public static function post()
	{

		$post =
		[
			'action' => \dash\request::post('orderaction'),
		];


		\lib\app\factor\action::add($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
