<?php
namespace content_a\setting\logo;


class model
{
	public static function post()
	{
		$result = null;

		\lib\app\setting\setup::upload_logo();

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Store logo updated"));
			\lib\store::refresh();
			\dash\notif::direct();
			\dash\redirect::pwd();
		}
	}
}
?>