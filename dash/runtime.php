<?php
namespace dash;


class runtime
{
	private static $runtime = [];


	public static function set($_key, $_group)
	{
		if(!$_group)
		{
			$_group = 'non';
		}

		if(!isset(self::$runtime[$_group]))
		{
			self::$runtime[$_group] = [];
		}

		self::$runtime[$_group][$_key] = microtime(true);
	}



	public static function db($_key)
	{
		self::set($_key, 'db');
	}


	public static function get()
	{
		return self::$runtime;
	}


	// call in shutdown function
	public static function show()
	{
		if(empty(self::$runtime))
		{
			return;
		}

		if(\dash\permission::supervisor())
		{
			$runtime = self::$runtime;

			$last_time = null;

			foreach ($runtime as $group => $value)
			{
				$len = 0;

				$header = 'Jibres-Runtime-'. $group. ': ';

				$text = '';

				foreach ($value as $key => $time)
				{
					if($last_time)
					{
						$len = floatval($time) - floatval($last_time);
					}

					$last_time = $time;

					$text .= $key. ': '. date("H:i:s", $time);

					if($len)
					{
						$text.= ' -len: '. round($len * 1000). ' ms';
					}

					$text .= ' | ';
				}

				@header($header. $text);
			}
		}
	}
}
?>