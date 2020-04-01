<?php
namespace dash\setting;


class fuel
{

	private static $fuel = null;
	private static $fuel_server = null;


	private static function load($_code)
	{
		if(!isset(self::$fuel[$_code]))
		{
			$detail = \dash\file::read(__DIR__. '/secret/fuel/'. $_code. '.secret.json');
			if($detail && is_string($detail))
			{
				$detail = json_decode($detail, true);
			}

			if(!is_array($detail))
			{
				$detail = [];
			}

			self::$fuel[$_code] = $detail;
		}


	}

	public static function server_name($_ip)
	{
		if(self::$fuel_server === null)
		{
			$detail = \dash\file::read(__DIR__. '/secret/fuel/servername.json');
			if($detail && is_string($detail))
			{
				$detail = json_decode($detail, true);
			}

			if(!is_array($detail))
			{
				$detail = [];
			}

			self::$fuel_server = $detail;
		}

		if(isset(self::$fuel_server[$_ip]))
		{
			return self::$fuel_server[$_ip];
		}

		return null;
	}


	public static function server($_code)
	{
		self::load($_code);

		if(isset(self::$fuel[$_code]))
		{
			return self::$fuel[$_code];
		}

		return null;
	}
}
?>