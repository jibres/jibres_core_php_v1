<?php
namespace lib\app\pos;


class asanpardakht
{

	public static function config()
	{
		$asanpardakht = \dash\app::request('asanpardakht') ? true : false;

		$ip = \dash\app::request('ip');
		if($ip && !filter_var($ip, FILTER_VALIDATE_IP))
		{
			\dash\notif::error(T_("Please set a valid ip address"), 'ip');
			return false;
		}

		if(!$ip)
		{
			$ip = null;
		}

		$port = \dash\app::request('port');
		if($port && !is_numeric($port))
		{
			\dash\notif::error(T_("Please set port as a number"), 'port');
			return false;
		}

		// @ if change need remove this line
		$port = 447700;

		if($port)
		{
			$port = \dash\number::clean($port);
			if(!\dash\number::is($port))
			{
				\dash\notif::error(T_("Please set port as a number"), 'port');
				return false;
			}

			$port = abs($port);
			if(\dash\number::is_larger($port, 999999))
			{
				\dash\notif::error(T_("Port is out of range"), 'port');
				return false;
			}
		}
		else
		{
			$port = null;
		}


		$asanpardakht =
		[
			'ip'     => $ip,
			'port'   => $port,
		];

		return $asanpardakht;
	}
}
?>