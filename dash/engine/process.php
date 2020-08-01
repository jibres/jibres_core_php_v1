<?php
namespace dash\engine;

class process
{

	private static $status = true;


	public static function continue()
	{
		self::$status = true;
	}


	public static function stop()
	{
		\dash\header::set(412);
		self::$status = false;
	}


	public static function status()
	{
		return self::$status;
	}
}
?>
