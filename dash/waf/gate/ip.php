<?php
namespace dash\waf\gate;
/**
 * dash main configure
 */
class ip
{
	public static function inspection($_ip = null)
	{
		$ip = null;
		if($_ip)
		{
			$ip = $_ip;
		}
		else
		{
			$ip = \dash\server::ip();
		}

		// we need something for this
		\dash\waf\gate\toys\only::something($ip);
		// only can be text
		\dash\waf\gate\toys\only::text($ip);

		// disallow html tags
		\dash\waf\gate\toys\block::tags($ip);
		// disallow some char inside ip
		\dash\waf\gate\toys\block::word($ip, '"');
		\dash\waf\gate\toys\block::word($ip, "'");
		\dash\waf\gate\toys\block::word($ip, "\n");

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
		\dash\waf\gate\toys\general::len($ip, 7, 15);
	}


	private static function ipv6($ip)
	{
		\dash\waf\gate\toys\general::len($ip, 2, 46);
	}
}
?>
