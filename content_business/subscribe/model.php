<?php
namespace content_business\subscribe;

class model
{
	public static function post()
	{
		$post                = [];
		$post['mobile']      = \dash\request::post('mobile');
		$result              = \dash\app\user::add($post);

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
			\dash\notif::ok(T_("Your mobile successfully added to subscribe list"));
			return true;
		}


		return false;

	}
}
?>