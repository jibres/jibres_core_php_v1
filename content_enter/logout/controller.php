<?php
namespace content_enter\logout;


class controller
{
	public static function routing()
	{
		\dash\header::set(301);
		\dash\log::set('userLogout');

		// get user logout
		\dash\utility\enter::set_logout(\dash\user::id());
	}
}
?>