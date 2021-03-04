<?php
namespace content_business\ticket\add;

class controller
{
	public static function routing()
	{
		\dash\utility\ip::check(true);

		\dash\csrf::set();

		if(\dash\user::id())
		{
			\dash\allow::file();
		}
	}
}
?>
