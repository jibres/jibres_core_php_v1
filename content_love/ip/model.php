<?php
namespace content_love\ip;


class model
{
	public static function post()
	{
		$ip = \dash\request::post('ip');
		$ip = \dash\validate::ip($ip);

		if(!$ip)
		{
			\dash\notif::error(T_("IP is required"), 'ip');
			return false;
		}

		// \dash\waf\ip::whitelist($ip);
		\dash\notif::ok("IP whitelisted. Nedd to fix");

	}
}
?>