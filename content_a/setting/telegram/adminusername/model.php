<?php
namespace content_a\setting\telegram\adminusername;


class model
{
	public static function post()
	{
		$post           = [];
		$post['adminusername'] = \dash\request::post('adminusername');

		\lib\app\setting\set::telegram_setting($post);

		\dash\redirect::pwd();
	}
}
?>