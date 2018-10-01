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
}
?>