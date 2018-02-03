<?php
namespace content\cronjob;
use \lib\debug;
use \lib\utility;

class model extends \mvc\model
{
	/**
	 * save cronjob form
	 */
	public function post_cronjob($_args = null)
	{

		$url = \lib\router::get_url(1);

		// \lib\db\mysql\tools\log::log($url, time(), 'cronjob.log', 'json');

		switch ($url)
		{
			case 'homepagenumber':
				$this->homepagenumber();
				break;

			default:
				return;
				break;
		}
	}


	/**
	 * check in this time have any report or no
	 */
	public function homepagenumber()
	{
		$time_now    = date("i");
		// every 10 minuts
		if(is_string($time_now) && mb_strlen($time_now) === 2 && $time_now{1} == '0')
		{
			\lib\utility\homepagenumber::set();
		}
	}


	public function calc()
	{
		$time_now = date("H:i");
		$date     = date("Y-m-d H:i:s");
		$query    =
		"
			SELECT teams.id AS `id` FROM teams
			WHERE DAY(teams.startplan)    = DAY('$date')
			AND   HOUR(teams.startplan)   = HOUR('$time_now')
			AND   MINUTE(teams.startplan) = MINUTE('$time_now')
		";

		$check_exist = \lib\db::get($query, 'id');

		if($check_exist && is_array($check_exist))
		{
			foreach ($check_exist as $key => $value)
			{
				$calc = new \lib\utility\calc($value);
				$calc->save(true);
				$calc->notify(true);
				$calc->type('calc_invoice');
				$calc->calc();
			}
		}
		else
		{
			return;
		}
	}


	/**
	 * ping every 1 min
	 */
	public function pinger()
	{
		$host = 'sarshomar.com';

		$ping = new \lib\utility\ping($host);

		$latency = $ping->ping();

		$saved_time = $this->get_last_pinged_time();

		$time_now = date("Y-m-d H:i:s");

		$msg = ClientIP. "\n";
		$msg .= $host. "\n";

		if ($latency !== false)
		{
			$run = true;
		  	$msg .= 'Latency is ' . $latency . ' ms';
		}
		else
		{
			$run = false;
			$msg .= "🔴 SERVER IS #DOWN!";
		}

		$timediff = strtotime($time_now) - strtotime($saved_time);

		if($timediff > 65)
		{
			$temp_msg = "\n 🔴 #I_AM_DOWN! 🔴 \n";
			$temp_msg .= " Last runtime: ". $saved_time;
			$msg = $temp_msg;
		}


		$default_send_service = \lib\utility\telegram::$force_send_telegram_service;

		if($run)
		{
			$this->set_last_pinged_time();
		}

		\lib\utility\telegram::$force_send_telegram_service = true;
		\lib\utility\telegram::$bot_key                     = '401647634:AAEUeTV5E7CYxZth-6TOWFHdjzABwVavJS0';
		\lib\utility\telegram::$save_log                    = false;

		\lib\utility\telegram::sendMessage("@jibres_monitor", $msg);

		\lib\utility\telegram::$force_send_telegram_service = $default_send_service;
		\lib\utility\telegram::$bot_key                     = null;
		\lib\utility\telegram::$save_log                    = true;


	}


	/**
	 * Gets the last pinged time.
	 */
	public function get_last_pinged_time()
	{
		$date = date("Y-m-d H:i:s");
		$url  = __DIR__ . '/last_ping_time.txt';

		if(!\lib\utility\file::exists($url))
		{
			\lib\utility\file::write($url, $date);
		}
		else
		{
			$date = \lib\utility\file::read($url);
		}
		return $date;
	}

	/**
	 * Sets the last pinged time.
	 */
	public function set_last_pinged_time()
	{
		$date = date("Y-m-d H:i:s");
		$url  = __DIR__ . '/last_ping_time.txt';
		\lib\utility\file::write($url, $date);
	}
}