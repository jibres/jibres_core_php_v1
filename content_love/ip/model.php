<?php
namespace content_love\ip;


class model
{
	public static function post()
	{
		if($remove_ip = \dash\request::post('removefile'))
		{
			if($remove_ip = \dash\validate::ip($remove_ip))
			{
				$result = \dash\waf\ip::remove_ip_file($remove_ip);

				if($result)
				{
					\dash\notif::ok(T_("File removed"));
				}
				\dash\redirect::pwd();
			}

			return;

		}

		if(\dash\request::post('remove'))
		{
			$folder = \dash\request::post('remove');

			if(in_array($folder, ['live','isolation','block','unblock','whitelist','blacklist', 'bot', 'human', 'ban']))
			{
				\dash\waf\ip::remove_folder($folder);
				\dash\notif::ok(T_("Folder removed"));
			}
			else
			{
				\dash\notif::error(T_("Invalid folder"));
			}
			\dash\redirect::pwd();
			return;
		}


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
				\dash\waf\ip::isolate($ip, $reason, true);
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

		\dash\notif::ok("IP ". $ip. ' Set On '. $status);
		return true;
	}
}
?>