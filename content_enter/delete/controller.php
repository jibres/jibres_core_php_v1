<?php
namespace content_enter\delete;

class controller
{
	public static function routing()
	{
		if(!\dash\user::login())
		{
			\dash\header::status(403, T_("Login error"));
		}

		\dash\utility\hive::set();
	}
}
?>