<?php
namespace lib;


class price
{
	private static $rate = 1000;

	public static function up($_number)
	{
		return floatval($_number) * self::$rate;
	}

	public static function down($_number)
	{
		return intval($_number) / self::$rate;
	}
}
?>