<?php
namespace lib;


class number
{
	private static $rate = 1000;

	public static function up($_number)
	{
		return floatval($_number);
		// return round(floatval($_number) * self::$rate);
	}

	public static function down($_number)
	{
		return floatval($_number);
		// return floatval($_number) / self::$rate;
	}
}
?>