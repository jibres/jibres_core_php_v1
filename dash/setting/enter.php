<?php
namespace dash\setting;


class enter
{

	private static $load = null;


	private static function load()
	{
		if(self::$load === null)
		{
			$json = \dash\file::read(__DIR__. '/secret/enter.secret.json');
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

	public static function force_enter_passcode()
	{
		self::load();

		if(isset(self::$load['force_enter_passcode']))
		{
			return self::$load['force_enter_passcode'];
		}

		return false;
	}
}
?>