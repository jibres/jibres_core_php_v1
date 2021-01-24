<?php
namespace content_business\ticket\view;

class model
{

	public static function post()
	{
		$post =
		[
			'content'     => \dash\request::post('content'),
		];

		\dash\app\ticket\add::to_my_ticket($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}

}
?>