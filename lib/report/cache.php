<?php
namespace lib\report;

class cache
{
	private static $load_cache_report_once = [];
	private static $loaded                 = false;


	private static function load_cache_report_once()
	{
		if(!self::$loaded)
		{
			self::$loaded = true;
			$result       = \lib\db\setting\get::by_cat_key('cache_report', 'cache_report');

			if($result)
			{
				var_dump($result);exit;
			}

		}
	}


	public static function get($_report_fn)
	{
		self::load_cache_report_once();

		$report_key = str_replace('\\', '_', $_report_fn[0]);
		$report_key .= '_'. $_report_fn[1];
		$report_key = trim($report_key, '_');

		$save = self::$load_cache_report_once;

		$calculate = false;

		if(isset(self::$load_cache_report_once[$report_key]))
		{
			$cache = self::$load_cache_report_once[$report_key];

			if(a($cache, 'diff'))
			{

			}
		}
		else
		{
			$calculate = true;
		}

		$diff = null;
		$last_update = null;
		if($calculate)
		{
			$last_update = date("Y-m-d H:i:s");
			$start_time  = microtime(true);
			$result      = call_user_func($_report_fn);
			$diff        = $start_time - microtime(true);
		}



		var_dump($report_key);

		var_dump(func_get_args());exit;
	}
}
?>