<?php
namespace dash\engine;

class flood
{
	private static $ipSecAddr = YARD.'jibres_ipsec/';

	public static function protection()
	{
		\dash\engine\ip::checkLimit();
		self::floodProtection();
	}


	public static function floodProtection()
	{
		// visitor request 10 times under e.g. 2 seconds will be stopped!
		$flood_interval = 1;

		$counter   = \dash\session::get('counter', 'flood');
		$last_post = \dash\session::get('last', 'flood');
		$ip        = \dash\session::get('ip', 'flood');

		if(!$counter)
		{
			$counter = 1;
		}

		// do nothing if ip is changed for this session
		if($ip && $ip === \dash\server::ip())
		{
			if($counter > 10)
			{
				if(($last_post + $flood_interval) > time())
				{
					// Use this if you want to reset counter
					// \dash\session::set(0, 'counter', 'flood');
					\dash\header::status(416, 'Please be patient');
				}
			}
		}

		// save session
		\dash\session::set('ip', \dash\server::ip(), 'flood');
		\dash\session::set('counter', $counter + 1, 'flood');
		\dash\session::set('last', time(), 'flood');
	}
}
?>
