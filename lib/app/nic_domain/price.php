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


	public static function renew($_period, $_expire_date = null)
	{
		$price = 0;
		if($_period === '5year')
		{
			$price = 14000;
		}
		else
		{
			$price = 4000;
		}

		if($_expire_date)
		{

			$date1 = date_create($_expire_date);
			$date2 = date_create(date("Y-m-d"));
			$diff  = date_diff($date2, $date1);
			$days  = 0;

			if(isset($diff->days))
			{
				$days = $diff->days;
			}

			if($days > 30 && $days < 60)
			{
				$price = $price * 2;
			}
		}

		return $price;
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