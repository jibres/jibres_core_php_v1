<?php
namespace content_my\domain\setting\dnsadvance;


class controller
{
	public static function routing()
	{
		\content_my\domain\setting\controller::routing();
		\dash\csrf::set();
	}
}
?>