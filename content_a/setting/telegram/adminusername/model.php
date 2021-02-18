<?php
namespace content_a\setting\telegram\adminusername;


class model
{
	public static function post()
	{

		$post =
		[
			'telegram'  => \dash\request::post('adminusername'),
		];

		\lib\app\store\edit::social($post);

		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
			\dash\notif::clean();
		}

		$post           = [];
		$post['adminusername'] = \dash\request::post('adminusername');

		\lib\app\setting\set::telegram_setting($post);

		\dash\redirect::pwd();
	}
}
?>