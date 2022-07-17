<?php
namespace dash\engine;


class runtime
{
	private static $runtime = [];

	public static function start_engine()
	{
		self::set('engine', 'start', true);
	}


	public static function set($_group, $_key, $_important = false)
	{
		if(!$_group)
		{
			$_group = 'non';
		}

		$i = count(self::$runtime) + 10;
		$i = 'x'. $i;

		self::$runtime[$i. '-'. $_group. '_'. $_key] = microtime(true);
	}

	public static function get()
	{
		return self::$runtime;
	}


	public static function json()
	{
		if(empty(self::$runtime))
		{
			return null;
		}

		$formatedResult = [];
		foreach (self::$runtime as $key => $startTime)
		{
			// calc diff of start and end
			$diff = microtime(true) - $startTime;
			$diff_round = round($diff, 2);
			// calc diff in second
			// $diff_Sec = intval($diff);

			$formatedResult[$key] = $diff_round. 's';
		}

		return json_encode($formatedResult, JSON_UNESCAPED_UNICODE);
	}


	public static function show()
	{
		if(empty(self::$runtime))
		{
			return;
		}

		self::set('engine', 'end', true);

		// if(supervisor)
		// {
		// 	$runtime = self::$runtime;

		// 	$last_time = null;

		// 	$len       = 0;
		// 	$last_time = 0;

		// 	foreach ($runtime as $key => $time)
		// 	{

		// 		if($last_time)
		// 		{
		// 			$len = floatval($time) - floatval($last_time);
		// 		}

		// 		$last_time = $time;

		// 		$header = 'x-RunTime-'. $key. ': ';

		// 		$header .= date("H:i:s", intval($time));

		// 		if($len)
		// 		{
		// 			$header.= ' -len '. round($len, 3). ' s';
		// 		}

		// 		@header($header);
		// 	}

		// }
	}


	// call in shutdown function
	public static function shutdown()
	{
		// self::show();
	}
}
?>