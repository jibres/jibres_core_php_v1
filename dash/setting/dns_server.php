<?php
namespace dash\setting;


class dns_server
{

	private static $load = null;


	private static function load()
	{
		if(self::$load === null)
		{
			$json = \dash\file::read(__DIR__. '/secret/dns_server.secret.json');
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

	// get jibres ip for add to a record of dns setting
	public static function ip()
	{
		self::load();
		if(isset(self::$load['ip']))
		{
			return self::$load['ip'];
		}

		return null;
	}

	public static function apikey()
	{
		self::load();
		if(\dash\url::isLocal())
		{
			$key = 'reza-apikey';
		}
		else
		{
			$key = 'apikey';
		}

		if(isset(self::$load[$key]))
		{
			return self::$load[$key];
		}

		return null;
	}
}
?>