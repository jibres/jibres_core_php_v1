<?php
namespace dash;


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
		$i = 'a'. $i;

		self::$runtime[$i. '_'. $_group. '_'. $_key] = microtime(true);
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

		return json_encode(self::$runtime, JSON_UNESCAPED_UNICODE);
	}


	// call in shutdown function
	public static function show()
	{
		if(empty(self::$runtime))
		{
			return;
		}

		self::set('engine', 'end', true);

		if(\dash\permission::supervisor())
		{
			$runtime = self::$runtime;

			$last_time = null;

			$i = 10;

			$len       = 0;
			$last_time = 0;
			$result = [];

			foreach ($runtime as $key => $time)
			{
				$i++;

				if($last_time)
				{
					$len = floatval($time) - floatval($last_time);
				}

				$last_time = $time;

				$header = 'x-RunTime-'. $i. '-'. $key. ': ';

				$header .= date("H:i:s", intval($time));

				if($len)
				{
					$header.= ' -len '. round($len, 3). ' s';
				}
				$result[] = $header;
			}

			if(\dash\url::module() !== 'smile')
			{
				\dash\log::file(implode("\n", $result), 'runtime', 'database');
			}
		}
	}
}
?>