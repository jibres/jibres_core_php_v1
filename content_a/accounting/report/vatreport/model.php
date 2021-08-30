<?php
namespace content_a\accounting\report\vatreport;

class model
{
	public static function post()
	{
		$post =
		[
			'quarter' => \dash\request::post('quarter'),
			'decide'  => \dash\request::post('decide'),
		];

		$result = \lib\app\tax\year\edit::edit($post, \lib\app\tax\year\get::default_year('id'));

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
			\dash\redirect::pwd();
		}
	}
}
?>
