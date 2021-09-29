<?php
namespace lib\report;

class cache
{
	public static function get($_report_fn)
	{
		$report_key = str_replace('\\', '_', $_report_fn[0]);
		$report_key .= '_'. $_report_fn[1];
		$report_key = trim($report_key, '_');

		$result    = \lib\db\setting\get::by_cat_key('cache_report', $_report_key);

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