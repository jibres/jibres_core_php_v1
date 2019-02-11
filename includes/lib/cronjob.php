<?php
namespace lib;

class cronjob
{

	public static function run()
	{
		switch (\dash\request::get('type'))
		{
			case 'homepagenumber':
				self::homepagenumber();
				break;

			case 'jibresplan':
				self::jibresplan();
				break;

			default:
				# code...
				break;
		}
	}



	private static function homepagenumber()
	{
		$time_now    = date("i");
		// every 10 minuts

		if((is_string($time_now) && mb_strlen($time_now) === 2 && $time_now{1} == '0') || \dash\permission::supervisor())
		{
			\lib\utility\homepagenumber::set();
		}
	}


	private static function jibresplan()
	{
		$time_now    = date("H:i");

		if(($time_now === '10:15') || \dash\permission::supervisor())
		{
			\lib\app\store\plan::set_notif();
		}

		$time_now    = date("i");
		// every 10 minuts

		if((is_string($time_now) && mb_strlen($time_now) === 2 && $time_now{1} == '0') || \dash\permission::supervisor())
		{
			\lib\app\store\plan::expire_plan();
		}
	}
}
?>