<?php
namespace content_account\security\rememberme;


class controller
{

	public static function routing()
	{
		\dash\csrf::set();
	}
}
?>