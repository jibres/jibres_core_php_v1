<?php
namespace dash\engine;


class runtime
{
	private static $runtime = [];

	public static function start_engine()
	{
		self::set('power', 'on', true);
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
		$prevTime = null;
		$totalTime = 0;
		foreach (self::$runtime as $key => $startTime)
		{
			if(!$prevTime)
			{
				$prevTime = $startTime;
			}

			// calc diff of start and end
			// $diff = microtime(true) - $startTime;
			// $diff_round = round($diff, 2);


			$diff_from_last = $startTime - $prevTime;
			$diff_from_last_round = round($diff_from_last, 2);
			$totalTime += round($diff_from_last, 2);
			// calc diff in second
			// $diff_Sec = intval($diff);

			$formatedResult[$key] = $diff_from_last_round. ' -> '. $totalTime;
			if($diff_from_last_round > 0.3)
			{
				$formatedResult[$key] .= str_repeat(' ***', intval($diff_from_last_round / 0.3));
			}

			// set prev time for next one
			$prevTime = $startTime;
		}

		return json_encode($formatedResult, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ;
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