<?php
namespace content_my\business\subdomain;


class controller
{
	public static function routing()
	{
		\content_my\business\creating::access_step('subdomain');


		\dash\csrf::set();
	}
}
?>
