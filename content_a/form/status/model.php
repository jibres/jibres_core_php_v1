<?php
namespace content_a\form\status;

class model
{
	public static function post()
	{
		$form_id = \dash\request::get('id');


		$post =
		[
			'status'     => \dash\request::post('status'),
		];

		$result = \lib\app\form\form\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>