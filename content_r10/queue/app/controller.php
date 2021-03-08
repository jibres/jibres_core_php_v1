<?php
namespace content_r10\queue\app;


class controller
{
	public static function routing()
	{
		// check server api
		\dash\waf\ip::only_allow_ip(['167.71.55.134', '194.5.192.80']);
	}
}
?>