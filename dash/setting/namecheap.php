<?php
namespace dash\setting;


class namecheap
{

	private static $load = null;


	private static function load()
	{
		if(self::$load === null)
		{
			$json = \dash\file::read(__DIR__. '/secret/namecheap.secret.json');

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


	public static function ApiUser()
	{
		self::load();
		if(isset(self::$load['ApiUser']))
		{
			return self::$load['ApiUser'];
		}

		return null;
	}


	public static function ApiKey()
	{
		self::load();
		if(isset(self::$load['ApiKey']))
		{
			return self::$load['ApiKey'];
		}

		return null;
	}


	public static function UserName()
	{
		self::load();
		if(isset(self::$load['UserName']))
		{
			return self::$load['UserName'];
		}

		return null;
	}



}
?>