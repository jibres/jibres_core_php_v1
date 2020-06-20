<?php
namespace dash\setting;


class telegram
{

	private static $load = null;


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


	public static function __callStatic($_key, $_value)
	{

		self::load();

		if($_key === 'all')
		{
			return self::$load;
		}

		if(array_key_exists($_key, self::$load))
		{
			return self::$load[$_key];
		}

		return null;
	}



	public static function broker_token()
	{
		self::load();
		if(isset(self::$load['broker_token']))
		{
			return self::$load['broker_token'];
		}

		return null;
	}
}
?>