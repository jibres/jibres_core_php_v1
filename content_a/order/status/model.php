<?php
namespace content_a\order\status;


class model
{

	public static function post()
	{

		if(\dash\request::post('removeorder') === 'removeorder')
		{
			\lib\app\factor\remove::remove(\dash\request::get('id'));
			\dash\redirect::to(\dash\url::this());
			return;
		}

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
