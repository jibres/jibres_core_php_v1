<?php
namespace content_sudo\permission;

class controller
{
	public static function routing()
	{
		\dash\utility\permissionlist::extract();
		\dash\code::boom();
	}

}
?>