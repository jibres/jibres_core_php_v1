<?php
namespace content_crm\ticket\view;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');

		$post =
		[
			'content'     => \dash\request::post_raw('answer'),
			'sendmessage' => \dash\request::post('sendmessage'),
		];

		\dash\app\ticket\answer::add($post, $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
