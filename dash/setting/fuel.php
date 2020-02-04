<?php
namespace dash\setting;


class fuel
{

	private static $fuel = null;
	private static $fuel_server = null;


	private static function load()
	{
		if(self::$fuel === null)
		{
			$json = \dash\file::read(__DIR__. '/secret/fuel.secret.json');
			if($json && is_string($json))
			{
				$json = json_decode($json, true);
			}

			if(!is_array($json))
			{
				$json = [];
			}

			self::$fuel = $json;
		}

		if(self::$fuel_server === null)
		{
			$json = \dash\file::read(__DIR__. '/secret/fuel_server.secret.json');
			if($json && is_string($json))
			{
				$json = json_decode($json, true);
			}

			if(!is_array($json))
			{
				$json = [];
			}

			self::$fuel_server = $json;
		}

	}

	public static function server_name($_ip)
	{
		self::load();

		if(isset(self::$fuel_server[$_ip]))
		{
			return self::$fuel_server[$_ip];
		}

		return null;
	}
}
?>