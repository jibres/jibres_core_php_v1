<?php
namespace content_a\accounting\year\vatsetting;

class model
{
	public static function post()
	{
		$post =
		[
			'remainvatlastyear' => \dash\request::post('remainvatlastyear'),
			'quorumprice'            => \dash\request::post('quorumprice'),
		];




		$result = \lib\app\tax\year\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
