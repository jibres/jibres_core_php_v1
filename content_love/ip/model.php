<?php
namespace content_love\ip;


class model
{
	public static function post()
	{
		$ip = \dash\request::get('ip');
		$ip = \dash\validate::ip($ip);

		$status = \dash\request::post('status');

		if(!$ip)
		{
			\dash\notif::error(T_("IP is required"), 'ip');
			return false;
		}

		$reason = 'by admin';

		switch ($status)
		{
			case 'isolate':
				\dash\waf\ip::isolate($ip, $reason);
				break;

			case 'block':
				\dash\waf\ip::block($ip, $reason);
				break;

			case 'unblock':
				\dash\waf\ip::unblock($ip, $reason);
				break;

			case 'whitelist':
				\dash\waf\ip::whitelist($ip, $reason);
				break;

			case 'blacklist':
				\dash\waf\ip::blacklist($ip, $reason);
				break;


			default:
				\dash\notif::ok("Invalid status");
				break;
		}
	}
}
?>