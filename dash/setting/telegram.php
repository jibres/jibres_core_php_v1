<?php
namespace dash\setting;


class telegram
{

	private static $load = null;

	private static $active_bot = 'master';


	private static function load()
	{
		if(self::$load === null)
		{
			$json = \dash\file::read(__DIR__. '/secret/telegram.secret.json');
			if($json && is_string($json))
			{
				$json = json_decode($json, true);
			}

			if(!is_array($json))
			{
				$json = [];
			}
			self::$load = $json;

		}

	}


	public static function active_bot($_set = null)
	{
		if($_set)
		{
			self::$active_bot = $_set;
		}

		return self::$active_bot;
	}



	public static function __callStatic($_key, $_value)
	{

		self::load();

		if($_key === 'all')
		{
			return a(self::$load, self::active_bot());
		}

		if(array_key_exists($_key, a(self::$load, self::active_bot())))
		{
			return self::$load[self::active_bot()][$_key];
		}

		return null;
	}



	public static function broker_token()
	{
		self::load();
		if(isset(self::$load[self::active_bot()]['broker_token']))
		{
			return self::$load[self::active_bot()]['broker_token'];
		}

		return null;
	}
}
?>