<?php
namespace dash\setting;


class sendgrid
{

	private static $load = null;


	private static function load()
	{
		if(self::$load === null)
		{
			$json = \dash\file::read(__DIR__. '/secret/sendgrid.secret.json');

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


	public static function broker_token()
	{
		self::load();
		if(isset(self::$load['broker_token']))
		{
			return self::$load['broker_token'];
		}

		return null;
	}


	public static function apikey()
	{
		self::load();
		if(isset(self::$load['apikey']))
		{
			return self::$load['apikey'];
		}

		return null;
	}


}
?>