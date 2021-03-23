<?php
namespace content\testselect1;


class controller
{
	public static function routing()
	{
		$time = [];
		$time['start'] = microtime(true);
		$time['start_master_fuel'] = microtime(true);
		$time['resutl_master'] = \dash\db::get('SELECT 1', null, false, 'master');
		$time['end_master_fuel'] = round(microtime(true) - $time['start_master_fuel'], 2). ' ms';

		$time['start_501_fuel'] = microtime(true);
		$time['resutl_501'] = \dash\db::get('SELECT 1', null, false, '501');
		$time['end_501_fuel'] = round(microtime(true) - $time['start_501_fuel'], 2). ' ms';

		$time['start_400_fuel'] = microtime(true);
		$time['resutl_400'] = \dash\db::get('SELECT 1', null, false, '400');
		$time['end_400_fuel'] = round(microtime(true) - $time['start_400_fuel'], 2). ' ms';

		$time['end'] = microtime(true);

		\dash\code::jsonBoom($time);
	}
}
?>