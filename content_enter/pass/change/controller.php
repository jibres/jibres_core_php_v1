<?php
namespace content_enter\pass\change;

class controller
{
	public static function routing()
	{
		if(!\dash\user::login())
		{
			\dash\header::status(403, T_("Login error"));
		}
	}
}
?>