<?php
namespace content_domain\transfer;


class controller
{
	public static function routing()
	{
		\content_domain\controller::check_login();
	}
}
?>