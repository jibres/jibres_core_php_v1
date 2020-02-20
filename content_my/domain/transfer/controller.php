<?php
namespace content_my\domain\transfer;


class controller
{
	public static function routing()
	{
		\content_my\domain\controller::check_login();
	}
}
?>