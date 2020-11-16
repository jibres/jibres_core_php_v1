<?php
namespace lib;


class price
{
	private static $rate = 100;

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



	public static function total_down($_number)
	{
		return floatval($_number);
		// return \lib\number::down(self::down($_number));
	}
}
?>