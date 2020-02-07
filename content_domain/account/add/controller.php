<?php
namespace content_domain\account\add;


class controller
{
	public static function routing()
	{
		\content_domain\controller::check_login();
	}
}
?>