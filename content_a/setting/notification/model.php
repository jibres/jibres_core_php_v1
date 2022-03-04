<?php
namespace content_a\setting\notification;


class model
{
	public static function post()
	{
		if(\dash\request::post('set_template') === 'set')
		{
			\lib\app\setting\notification::set_template(\dash\request::post('event'), \dash\request::post('template'));
		}
		else
		{
			$post = \dash\request::post();
			\lib\app\setting\notification::set_setting($post);
		}

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Saved"));
			\dash\redirect::pwd();
		}
	}
}
?>
