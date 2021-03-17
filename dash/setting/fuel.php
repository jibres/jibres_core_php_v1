<?php
namespace dash\setting;


class fuel
{

	private static $fuel = null;


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