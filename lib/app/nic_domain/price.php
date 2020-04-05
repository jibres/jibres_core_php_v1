<?php
namespace lib\app\nic_domain;


class price
{

	public static function register($_period)
	{
		if($_period === '5year')
		{
			return 15000;
		}
		else
		{
			return 5000;
		}
	}


	public static function renew($_period)
	{
		if($_period === '5year')
		{
			return 15000;
		}
		else
		{
			return 5000;
		}
	}


	public static function transfer()
	{
		return 5000;
	}


	public static function register_compare($_period)
	{
		if($_period === '5year')
		{
			return 30000;
		}
		else
		{
			return 6000;
		}
	}


	public static function register_string($_period)
	{
		$string = \dash\fit::number(self::register($_period));
		$string .= ' '. T_("Toman");
		return $string;
	}


	public static function renew_string($_period)
	{
		$string = \dash\fit::number(self::renew($_period));
		$string .= ' '. T_("Toman");
		return $string;
	}

}
?>