<?php
namespace lib\app\store;


class analytics
{


	public static function average_creating_time()
	{
		$time = \lib\db\store_analytics\get::average_creating_time();
		return $time;
	}
}
?>