<?php
namespace content_business\profile\notifications\setting;


class model
{
	public static function post()
	{
		$post = \dash\request::post();

		\lib\app\setting\notification::set_user_setting($post, \dash\user::code());

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Saved"));
		}


	}
}
?>
