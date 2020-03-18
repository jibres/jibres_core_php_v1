<?php
namespace content_api;


class controller
{
	public static function routing()
	{
		\dash\header::status(410, T_("This version of api is expired"));
	}
}
?>