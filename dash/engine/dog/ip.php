<?php
namespace dash\engine\dog;
/**
 * dash main configure
 */
class ip
{
	public static function inspection($_ip)
	{
		// check ip is valid or not
		if(!filter_var($_ip, FILTER_VALIDATE_IP))
		{
			\dash\header::status(412, 'Hi Father!!');
		}
		// only can be text
		\dash\engine\dog\toys\only::text($_ip);

		if(filter_var($_ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
		{
		  self::ipv4($_ip);
		}
		elseif(filter_var($_ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6))
		{
		  self::ipv6($_ip);
		}
		else
		{
			\dash\header::status(412, 'Hi Father!!!');
		}
	}


	private static function ipv4($_ip)
	{
		\dash\engine\dog\toys\general::len($_ip, 7, 15);
	}


	private static function ipv6($_ip)
	{
		\dash\engine\dog\toys\general::len($_ip, 2, 46);

	}
}
?>
