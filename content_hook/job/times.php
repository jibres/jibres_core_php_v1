<?php
namespace content_hook\job;


trait times
{

	public static function daily_on($_hours)
	{
		$time_now    = date("H");

		if((is_string($time_now) && $time_now === $_hours))
		{
			$daily_log_file = __DIR__. '/daily.me.json';

			$need_create = false;

			$daily_log = [];

			$date_now = date("Y-m-d");

			if(!is_file($daily_log_file))
			{
				$need_create = true;
			}
			else
			{
				$daily_log = \dash\file::read($daily_log_file);
				$daily_log = json_decode((string) $daily_log, true);
				if(!is_array($daily_log))
				{
					$need_create = true;
					$daily_log = [];
				}

				if(isset($daily_log['date']) && $daily_log['date'] == $date_now)
				{
					// ok
				}
				else
				{
					\dash\file::delete($daily_log_file);
					$need_create = true;
				}
			}

			if($need_create)
			{
				$daily_log['date'] = date("Y-m-d");
			}

			$need_run_today = false;
			if(!isset($daily_log[$_hours]))
			{
				$need_run_today = true;
				$daily_log[$_hours] = date("Y-m-d H:i:s");
			}

			if($need_create || $need_run_today)
			{
				\dash\file::write($daily_log_file, json_encode($daily_log, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

				return true;
			}

		}
		return false;
	}

	public static function at($_time)
	{
		$time_now    = date("H:i");

		if((is_string($time_now) && $time_now === $_time))
		{
			return true;
		}
		return false;
	}


	public static function at_00_clock()
	{
		$time_now    = date("H:i");
		if((is_string($time_now) && $time_now === '00:00'))
		{
			return true;
		}
		return false;
	}


	public static function every_hour()
	{
		$time_now    = date("i");
		if((is_string($time_now) && mb_strlen($time_now) === 2 && in_array($time_now, ['00'])))
		{
			return true;
		}
		return false;
	}


	public static function in_hour($_hours, $_min = 19)
	{
		$hour_now    = date("H");
		if((is_string($hour_now) && in_array($hour_now, $_hours)))
		{
			$min_now    = date("i");
			if((intval($min_now) === intval($_min)))
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
		if((is_string($time_now) && mb_strlen($time_now) === 2 && in_array($time_now, ['00', '30'])))
		{
			return true;
		}
		return false;
	}


	public static function every_10_min()
	{
		$time_now    = date("i");
		// every 10 minuts
		if((is_string($time_now) && mb_strlen($time_now) === 2 && substr($time_now, 1, 1) == '0'))
		{
			return true;
		}
		return false;
	}


	public static function every_5_min()
	{
		$time_now    = date("i");
		// every 5 minuts
		if((is_string($time_now) && mb_strlen($time_now) === 2 && in_array(substr($time_now, 1, 1), ['0', '5']) ))
		{
			return true;
		}
		return false;
	}
}
?>