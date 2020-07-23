<?php
namespace dash\utility\pay;


class currency
{
	public static function change_to_rial($_amount)
	{
		return $_amount * 10;
	}

	public static function change_from_rial($_amount)
	{
		return $_amount / 10;
	}
}
?>
