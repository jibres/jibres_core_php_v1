<?php
namespace content\bug;


class controller
{
	public static function routing()
	{
		\dash\utility\ip::check();

		\dash\csrf::set();
	}
}
?>
