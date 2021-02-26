<?php
namespace dash\engine\dog;
/**
 * dash main configure
 */
class ip
{
	public static function inspection($_ip = null)
	{
		if(!$_ip)
		{
			$ip = \dash\server::ip();
		}

		// we need something for this
		\dash\engine\dog\toys\only::something($ip);
		// only can be text
		\dash\engine\dog\toys\only::text($ip);

		// check ip is valid or not
		if(!filter_var($ip, FILTER_VALIDATE_IP))
		{
			\dash\header::status(412, 'Hi Father!!');
		}

		if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
		{
		  self::ipv4($ip);
		}
		elseif(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6))
		{
		  self::ipv6($ip);
		}
		else
		{
			\dash\header::status(412, 'Hi Father!!!');
		}
	}


	private static function ipv4($ip)
	{
		\dash\engine\dog\toys\general::len($ip, 7, 15);
	}


	private static function ipv6($ip)
	{
		\dash\engine\dog\toys\general::len($ip, 2, 46);
	}
}
?>
