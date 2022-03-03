<?php
namespace content_a\setting\notification;


class model
{
	public static function post()
	{
		$post = \dash\request::post();

		\lib\app\setting\notification::set_setting($post);

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Saved"));
		}



	}
}
?>
