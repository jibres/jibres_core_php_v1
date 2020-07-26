<?php
namespace lib\app\nic_domain;


class price
{

	public static function register($_period)
	{
		if($_period === '5year')
		{
			return 14000;
		}
		else
		{
			return 4000;
		}
	}


	public static function renew($_period)
	{
		if($_period === '5year')
		{
			return 14000;
		}
		else
		{
			return 4000;
		}
	}


	public static function transfer()
	{
		return 4000;
	}


	public static function register_compare($_period)
	{
		if($_period === '5year')
		{
			return 48000;
		}
		else
		{
			return 16000;
		}
	}


	public static function register_string($_period)
	{
		$string = \dash\fit::number(self::register($_period));
		$string .= ' '. \lib\currency::unit();
		return $string;
	}


	public static function renew_string($_period)
	{
		$string = \dash\fit::number(self::renew($_period));
		$string .= ' '. \lib\currency::unit();
		return $string;
	}

}
?>