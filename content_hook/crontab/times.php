<?php
namespace content_hook\crontab;


trait times
{


	public static function at($_time)
	{
		$time_now    = date("H:i");

		if((is_string($time_now) && $time_now === $_time) || \dash\permission::supervisor())
		{
			return true;
		}
		return false;
	}


	public static function at_00_clock()
	{
		$time_now    = date("H:i");
		if((is_string($time_now) && $time_now === '00:00') || \dash\permission::supervisor())
		{
			return true;
		}
		return false;
	}


	public static function every_hour()
	{
		$time_now    = date("i");
		if((is_string($time_now) && mb_strlen($time_now) === 2 && in_array($time_now, ['00'])) || \dash\permission::supervisor())
		{
			return true;
		}
		return false;
	}


	public static function in_hour($_hours, $_min = 19)
	{
		$hour_now    = date("H");
		if((is_string($hour_now) && in_array($hour_now, $_hours)) || \dash\permission::supervisor())
		{
			$min_now    = date("i");
			if((intval($min_now) === intval($_min)) || \dash\permission::supervisor())
			{
				return true;
			}
		}
		return false;
	}


	public static function every_30_min()
	{
		$time_now    = date("i");
		// every 30 minuts
		if((is_string($time_now) && mb_strlen($time_now) === 2 && in_array($time_now, ['00', '30'])) || \dash\permission::supervisor())
		{
			return true;
		}
		return false;
	}


	public static function every_10_min()
	{
		$time_now    = date("i");
		// every 10 minuts
		if((is_string($time_now) && mb_strlen($time_now) === 2 && substr($time_now, 0, 1) == '0') || \dash\permission::supervisor())
		{
			return true;
		}
		return false;
	}


	public static function every_5_min()
	{
		$time_now    = date("i");
		// every 5 minuts
		if((is_string($time_now) && mb_strlen($time_now) === 2 && in_array(substr($time_now, 1, 1), ['0', '5']) ) || \dash\permission::supervisor())
		{
			return true;
		}
		return false;
	}
}
?>