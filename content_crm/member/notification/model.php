<?php
namespace content_crm\member\notification;


class model
{
	public static function post()
	{
		$post = \dash\request::post();

		\lib\app\setting\notification::set_user_setting($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Saved"));
		}



	}
}
?>
