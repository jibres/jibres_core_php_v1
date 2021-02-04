<?php
namespace content_crm\notification\sendgroup;


class model
{
	public static function post()
	{
		$post          = [];
		$post['group'] = \dash\request::post('group');
		$post['text']  = \dash\request::post('text');

		$result = \dash\app\log\add::notif_group($post);

		\dash\redirect::pwd();


	}
}
?>
