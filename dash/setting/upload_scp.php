<?php
namespace dash\setting;


class upload_scp
{

	private static $load = null;


	private static function load()
	{
		if(self::$load === null)
		{
			$json = \dash\file::read(__DIR__. '/secret/upload_scp.secret.json');
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

	public static function host()
	{
		self::load();

		if(isset(self::$load['host']))
		{
			return self::$load['host'];
		}

		return false;
	}


	public static function username()
	{
		self::load();

		if(isset(self::$load['username']))
		{
			return self::$load['username'];
		}

		return false;
	}


	public static function password()
	{
		self::load();

		if(isset(self::$load['password']))
		{
			return self::$load['password'];
		}

		return false;
	}


	public static function known_host()
	{
		self::load();

		if(isset(self::$load['known_host']))
		{
			return self::$load['known_host'];
		}

		return false;
	}


	public static function port()
	{
		self::load();

		if(isset(self::$load['port']))
		{
			return self::$load['port'];
		}

		return false;
	}
}
?>