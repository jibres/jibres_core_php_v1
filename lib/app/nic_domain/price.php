<?php
namespace lib\app\nic_domain;


class price
{

	public static function register($_period)
	{
		if($_period === '5year')
		{
			return 42000;
		}
		else
		{
			return 14000;
		}
	}


	public static function renew($_period, $_expire_date = null, $_domain_is_locked = false)
	{
		$price = 0;
		if($_period === '5year')
		{
			$price = 42000;
		}
		else
		{
			$price = 14000;
		}

		if($_expire_date)
		{
			// $expire_date = strtotime(date("Y-m-d", strtotime("-29 days"))); // for test
			// $expire_date = strtotime($_expire_date);
			// $now         = strtotime(date("Y-m-d"));

			// $_30_days    = 60*60*24*30;
			// $_60_days    = 60*60*24*60;

			// $diff = $now - $expire_date;

			// if($diff >= $_30_days && $diff <= $_60_days)
			{
				if($_domain_is_locked)
				{
					$price = $price * 2;
				}
			}
		}

		return $price;
	}


	public static function transfer()
	{
		return 14000;
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