<?php
namespace dash\setting;


class onlinenic
{

	private static $load = null;


	private static function load()
	{
		if(self::$load === null)
		{
			if(\dash\url::isLocal())
			{
				$json = \dash\file::read(__DIR__. '/secret/onlinenic_test.secret.json');
			}
			else
			{
				$json = \dash\file::read(__DIR__. '/secret/onlinenic.secret.json');
			}

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

	public static function user()
	{
		self::load();
		if(isset(self::$load['user']))
		{
			return self::$load['user'];
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


	public static function password()
	{
		self::load();
		if(isset(self::$load['password']))
		{
			return self::$load['password'];
		}

		return null;
	}







}
?>