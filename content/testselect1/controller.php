<?php
namespace content\testselect1;


class controller
{
	public static function routing()
	{
		$time = [];
		$time['start'] = microtime(true);
		$time['start_master_fuel'] = microtime(true);
		\dash\db::get('SELECT NULL', null, false, 'master');
		$time['end_master_fuel'] = round(microtime(true) - $time['start_master_fuel'], 2). ' ms';

		$time['start_501_fuel'] = microtime(true);
		\dash\db::get('SELECT NULL', null, false, '501');
		$time['end_501_fuel'] = round(microtime(true) - $time['start_501_fuel'], 2). ' ms';

		$time['start_400_fuel'] = microtime(true);
		\dash\db::get('SELECT NULL', null, false, '400');
		$time['end_400_fuel'] = round(microtime(true) - $time['start_400_fuel'], 2). ' ms';

		$time['end'] = microtime(true);

		\dash\code::jsonBoom($time);
	}
}
?>