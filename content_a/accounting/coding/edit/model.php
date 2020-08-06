<?php
namespace content_a\accounting\coding\edit;

class model
{
	public static function post()
	{
		$post =
		[
			'title' => \dash\request::post('title'),
		];

		$result = \lib\app\tax\coding\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
