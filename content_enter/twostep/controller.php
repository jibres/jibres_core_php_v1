<?php
namespace content_enter\twostep;


class controller
{
	public static function routing()
	{
		if(!\dash\user::login())
		{
			\dash\header::status(403, T_("Please login to continue"));
		}

		\dash\csrf::set();
	}
}
?>