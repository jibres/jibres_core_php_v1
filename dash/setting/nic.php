<?php
namespace dash\setting;


class nic
{

	private static $load = null;


	private static function load()
	{
		if(self::$load === null)
		{
			$json = \dash\file::read(__DIR__. '/secret/nic.secret.json');
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

	public static function token()
	{
		self::load();
		if(isset(self::$load['token']))
		{
			return self::$load['token'];
		}

		return null;
	}


	public static function curl_token()
	{
		self::load();
		if(isset(self::$load['curl_token']))
		{
			return self::$load['curl_token'];
		}

		return null;
	}

}
?>