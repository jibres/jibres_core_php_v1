<?php
namespace content\contact;


class controller
{
	public static function routing()
	{
		\dash\utility\ip::check();

		\dash\csrf::set();
	}
}
?>
