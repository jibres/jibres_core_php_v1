<?php
namespace dash\waf;

class dog
{
	private static $dogGame   = null;
	private static $dogBlock  = null;
	private static $dogPeriod = null;


	public static function bark()
	{
		// ip
		self::grade('ip', true, 10);
		\dash\waf\gate\ip::inspection();

		// agent
		self::grade('agent', true, 9);
		\dash\waf\gate\agent::inspection();

		// cookie
		self::grade('cookie', true, 3);
		\dash\waf\gate\cookie::inspection();

		// headers
		self::grade('header', true, 5);
		\dash\waf\gate\headers::inspection();

		// get
		self::grade('get', false, 3);
		\dash\waf\gate\get::inspection();

		// method
		self::grade('method', true, 7);
		\dash\waf\gate\method::inspection();

		// file
		self::grade('file', true, 8);
		\dash\waf\gate\file::inspection();

		// phpinput
		self::grade('phpinput', false, 2);
		\dash\waf\gate\phpinput::inspection();

		// post
		self::grade('post', false, 1);
		\dash\waf\gate\post::inspection();

		// needless to check request. the request is merge of get,post

		// check
	}


	public static function grade($_game, $_block, $_priority)
	{
		self::$dogGame  = $_game;
		self::$dogBlock = $_block;

		// set priority
		if($_priority < 1 || $_priority > 10)
		{
			$_priority = 7;
		}
		self::$dogPeriod = $_priority;
	}


	public static function BITE($_reason, $_status)
	{
		// sorry!
		// i must bite you

		// add module to reason for log
		$_reason = self::$dogGame. ' - '. $_reason;

		if(self::$dogBlock)
		{
			$daysBlocked = self::$dogPeriod * 60 * 24;
			\dash\waf\ip::blockIP($daysBlocked, $_reason);
		}
		else
		{
			\dash\waf\ip::isolateIP(self::$dogPeriod, $_reason);
		}

		\dash\header::status(418);
	}
}
?>
