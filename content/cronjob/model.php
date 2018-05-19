<?php
namespace content\cronjob;


class model
{
	/**
	 * save cronjob form
	 */
	public static function post()
	{
		if(!\dash\option::config('cronjob','status'))
		{
			return;
		}

		$url = \dash\request::get('type');

		// \lib\db\mysql\tools\log::log($url, time(), 'cronjob.log', 'json');

		self::homepagenumber();

		// switch ($url)
		// {
		// 	case 'homepagenumber':
		// 		break;

		// 	default:
		// 		return;
		// 		break;
		// }
	}


	/**
	 * check in this time have any report or no
	 */
	public static function homepagenumber()
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